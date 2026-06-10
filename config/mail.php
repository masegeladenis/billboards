<?php
/**
 * Mail Configuration
 * Configure your SMTP settings here
 */

return [
    'host' => 'smtp.gmail.com',           // SMTP server (Gmail, Mailgun, SendGrid, etc.)
    'port' => 587,                         // SMTP port (587 for TLS, 465 for SSL)
    'username' => 'gvackydennese11@gmail.com',  // SMTP username
    'password' => 'dnyxvatcjlcfbdjs',     // SMTP password (use App Password for Gmail)
    'encryption' => 'tls',                 // 'tls' or 'ssl'
    'from_email' => 'noreply@shulehub.ac.tz',
    'from_name' => 'Billboard Manager',
    'reply_to' => 'support@shulehub.ac.tz',

    // Notification recipients
    'admin_email' => 'masegeladenis@gmail.com',  // Admin notification email
];
