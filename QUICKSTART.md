# Billboard Management System - Quick Start Guide

## 5-Minute Setup

### 1. Create Database
```sql
CREATE DATABASE billboard_db;
USE billboard_db;

-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    company_name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Advertisements Table
CREATE TABLE advertisements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    ad_type ENUM('text', 'image', 'video') NOT NULL,
    content LONGTEXT,
    media_path VARCHAR(500),
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Schedule Table
CREATE TABLE schedule_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ad_id INT NOT NULL,
    day_of_week VARCHAR(10) NOT NULL,
    start_date DATE,
    end_date DATE,
    is_enabled TINYINT(1) DEFAULT 1,
    FOREIGN KEY (ad_id) REFERENCES advertisements(id)
);
```

### 2. Start Servers
- Start **Apache** in XAMPP
- Start **MySQL** in XAMPP

### 3. Access Application
```
http://localhost/announcement/public/index.php
```

### 4. Register Account
- Email: your@email.com
- Password: yourpassword
- Name: Your Name

### 5. Create Your First Ad
1. Go to Dashboard
2. Select Ad Type (Text)
3. Enter Title & Content
4. Set Display Time (e.g., 08:00 - 20:00)
5. Select Days (All)
6. Click "Create Advertisement"

### 6. View Billboard
Click "View Billboard" or go to:
```
http://localhost/announcement/public/display.php
```

## Common Tasks

### Upload Image Ad
1. Go to Dashboard
2. Select "Image" type
3. Click file upload area
4. Select image (JPG, PNG, GIF)
5. Set time window
6. Create

### Upload Video Ad
1. Select "Video" type
2. Upload MP4 file
3. Set display time
4. Create

### Schedule Ad for Specific Days
1. Select days (e.g., only Mon-Fri)
2. Optional: Set date range
3. Create

### Make Ad Inactive
- Click "Deactivate" on ad card

### Delete Ad
- Click "Delete" on ad card

## API Quick Reference

### Login
```bash
curl -X POST http://localhost/announcement/api/auth.php \
  -H "Content-Type: application/json" \
  -c cookies.txt \
  -d '{"email":"user@email.com","password":"pass"}'
```

### Create Text Ad
```bash
curl -X POST http://localhost/announcement/api/ads.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title":"Sale",
    "ad_type":"text",
    "content":"50% OFF!",
    "start_time":"09:00",
    "end_time":"21:00",
    "days":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"]
  }'
```

### Upload File
```bash
curl -X POST http://localhost/announcement/api/upload.php \
  -b cookies.txt \
  -F "file=@/path/to/image.jpg"
```

## Display Features

- **Auto-rotation**: Changes ad every 10 seconds
- **Navigation**: Use Previous/Next buttons to manually switch
- **Current Time**: Shows display time window in corner
- **Auto-refresh**: Updates every minute
- **Smart Filtering**: Only shows ads that match:
  - Today's day of week
  - Current time
  - Active status
  - Date range (if set)

## File Uploads

**Location**: `/announcement/uploads/`

**Supported**:
- Images: JPG, PNG, GIF
- Videos: MP4

**Size Limit**: 100MB per file

## Troubleshooting

### 404 on login page
- Check Apache is running
- URL should be: `http://localhost/announcement/public/index.php`

### Can't upload files
- Check `/uploads/` folder exists
- Set folder permissions: `chmod 755 uploads/`

### No ads on display
- Ad must be marked as "Active"
- Current time must be within start/end time
- Today must be in selected days
- Check date range if set

## URLs

| Page | URL |
|------|-----|
| Login | http://localhost/announcement/public/index.php |
| Dashboard | http://localhost/announcement/public/dashboard.php |
| Display | http://localhost/announcement/public/display.php |

## Database Connection

Edit `config/Database.php` if needed:
```php
private $host = 'localhost';
private $db_name = 'billboard_db';
private $user = 'root';
private $password = '';  // Leave empty if no password
```

---

**Questions?** Check README.md for complete API documentation.
