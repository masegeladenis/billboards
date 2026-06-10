<?php
/**
 * Minimal SMTP mailer — no external dependencies.
 * Supports STARTTLS (port 587) and implicit SSL (port 465) with AUTH LOGIN.
 */
class Mailer {
    private $cfg;
    public $error = null;

    public function __construct() {
        $this->cfg = require __DIR__ . '/mail.php';
    }

    public function send($to, $subject, $html) {
        $cfg = $this->cfg;
        $errno = 0; $errstr = '';

        $target = ($cfg['encryption'] === 'ssl' ? 'ssl://' : '') . $cfg['host'];
        $sock = @fsockopen($target, $cfg['port'], $errno, $errstr, 15);
        if (!$sock) { $this->error = "Could not connect to SMTP server: $errstr"; return false; }
        stream_set_timeout($sock, 15);

        $read = function () use ($sock) {
            $data = '';
            while ($line = fgets($sock, 515)) {
                $data .= $line;
                if (isset($line[3]) && $line[3] === ' ') break;
            }
            return $data;
        };
        $cmd = function ($c) use ($sock, $read) {
            fwrite($sock, $c . "\r\n");
            return $read();
        };
        $fail = function ($msg) use ($sock) {
            $this->error = $msg;
            fclose($sock);
            return false;
        };

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $read(); // server greeting
        $cmd('EHLO ' . $host);

        if ($cfg['encryption'] === 'tls') {
            $r = $cmd('STARTTLS');
            if (strpos($r, '220') !== 0) return $fail("STARTTLS refused: $r");
            $crypto = STREAM_CRYPTO_METHOD_TLS_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) $crypto |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) $crypto |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
            if (!stream_socket_enable_crypto($sock, true, $crypto)) return $fail('TLS negotiation failed');
            $cmd('EHLO ' . $host);
        }

        $cmd('AUTH LOGIN');
        $cmd(base64_encode($cfg['username']));
        $r = $cmd(base64_encode($cfg['password']));
        if (strpos($r, '235') !== 0) return $fail("SMTP authentication failed: $r");

        // Envelope sender must be the authenticated account (Gmail requirement)
        $r = $cmd('MAIL FROM:<' . $cfg['username'] . '>');
        if (strpos($r, '250') !== 0) return $fail("MAIL FROM rejected: $r");
        $r = $cmd('RCPT TO:<' . $to . '>');
        if (strpos($r, '250') !== 0 && strpos($r, '251') !== 0) return $fail("Recipient rejected: $r");

        $r = $cmd('DATA');
        if (strpos($r, '354') !== 0) return $fail("DATA rejected: $r");

        $headers  = 'From: =?UTF-8?B?' . base64_encode($cfg['from_name']) . '?= <' . $cfg['from_email'] . ">\r\n";
        $headers .= 'Reply-To: ' . $cfg['reply_to'] . "\r\n";
        $headers .= 'To: <' . $to . ">\r\n";
        $headers .= 'Subject: =?UTF-8?B?' . base64_encode($subject) . "?=\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= 'Date: ' . date('r') . "\r\n";

        $body = preg_replace('/^\./m', '..', str_replace("\n", "\r\n", str_replace("\r\n", "\n", $html)));

        $r = $cmd($headers . "\r\n" . $body . "\r\n.");
        if (strpos($r, '250') !== 0) return $fail("Message rejected: $r");

        $cmd('QUIT');
        fclose($sock);
        return true;
    }
}
