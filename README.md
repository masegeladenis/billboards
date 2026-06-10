# Billboard Management System - API Documentation

A complete PHP-based billboard advertisement management system with user authentication, advertisement creation, scheduling, and real-time display capabilities.

## Features

✅ User Registration & Authentication (Email/Password)
✅ Create Text, Image, and Video Advertisements  
✅ Time-based Display Scheduling (Daily, by Day of Week)
✅ Billboard Display with Auto-rotation
✅ Responsive Dashboard for Ad Management
✅ Media Upload Support (Images and Videos)
✅ Active/Inactive Toggle for Advertisements

## System Requirements

- PHP 7.4+
- MySQL 5.7+
- Apache Server (XAMPP)
- Modern Web Browser

## Installation & Setup

### Step 1: Database Setup

1. Open phpMyAdmin at `http://localhost/phpmyadmin`
2. Copy the SQL commands from `config/setup.sql`
3. Create a new database or paste into the query tab
4. Execute the SQL to create all necessary tables

Or, execute via terminal:
```bash
mysql -u root -p < config/setup.sql
```

### Step 2: Database Configuration

Edit `config/Database.php` and update if needed:
```php
private $host = 'localhost';        // MySQL host
private $db_name = 'billboard_db';  // Database name
private $user = 'root';              // MySQL user
private $password = '';              // MySQL password
```

### Step 3: Access the Application

Open your browser and navigate to:
```
http://localhost/announcement/public/index.php
```

## API Endpoints

### Authentication

#### Register User
```
POST /announcement/api/auth.php

Body:
{
    "email": "user@example.com",
    "password": "secure_password",
    "name": "John Doe",
    "company_name": "ABC Company"
}

Response:
{
    "success": true,
    "message": "User registered successfully",
    "user_id": 1
}
```

#### Login User
```
POST /announcement/api/auth.php

Body:
{
    "email": "user@example.com",
    "password": "secure_password"
}

Response:
{
    "success": true,
    "message": "Login successful",
    "user": {
        "id": 1,
        "email": "user@example.com",
        "name": "John Doe",
        "company_name": "ABC Company"
    }
}
```

#### Logout
```
POST /announcement/api/auth.php (logout)
```

#### Check Authentication Status
```
GET /announcement/api/auth.php

Response:
{
    "success": true,
    "user": {...}
}
```

### Advertisements

#### Create Advertisement
```
POST /announcement/api/ads.php

Body:
{
    "title": "Summer Sale",
    "description": "Optional description",
    "ad_type": "text|image|video",
    "content": "Your text content here (for text ads)",
    "media_path": "/announcement/uploads/image.jpg (for image/video ads)",
    "start_time": "08:00",
    "end_time": "20:00",
    "rotation_order": 1,
    "days": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    "start_date": "2024-01-01 (optional)",
    "end_date": "2024-12-31 (optional)"
}

Response:
{
    "success": true,
    "message": "Advertisement created successfully",
    "ad_id": 1
}
```

#### Get User's Advertisements
```
GET /announcement/api/ads.php

Response:
{
    "success": true,
    "ads": [
        {
            "id": 1,
            "user_id": 1,
            "title": "Summer Sale",
            "ad_type": "text",
            "content": "Your text content",
            "start_time": "08:00:00",
            "end_time": "20:00:00",
            "is_active": 1,
            "created_at": "2024-01-15 10:30:00",
            "updated_at": "2024-01-15 10:30:00"
        }
    ]
}
```

#### Get Single Advertisement
```
GET /announcement/api/ads.php?id=1

Response:
{
    "success": true,
    "ad": {...},
    "schedules": [...]
}
```

#### Update Advertisement
```
PUT /announcement/api/ads.php?id=1

Body:
{
    "title": "Updated Title",
    "description": "Updated description",
    ...
}
```

#### Delete Advertisement
```
DELETE /announcement/api/ads.php?id=1

Response:
{
    "success": true,
    "message": "Advertisement deleted successfully"
}
```

#### Toggle Advertisement Active Status
```
PUT /announcement/api/ads.php?id=1

Response:
{
    "success": true,
    "message": "Advertisement status updated"
}
```

### Media Upload

#### Upload Advertisement Media
```
POST /announcement/api/upload.php

Body: FormData
{
    "file": <File Object>
}

Response:
{
    "success": true,
    "message": "File uploaded successfully",
    "file_path": "/announcement/uploads/ad_123456_1234567890.jpg"
}

Allowed File Types:
- JPEG, PNG, GIF (Images)
- MP4 (Videos)

Max File Size: 100MB
```

### Schedule Management

#### Add Schedule
```
POST /announcement/api/schedule.php

Body:
{
    "ad_id": 1,
    "day_of_week": "Monday",
    "start_date": "2024-01-01 (optional)",
    "end_date": "2024-12-31 (optional)"
}
```

#### Delete Schedule
```
DELETE /announcement/api/schedule.php?schedule_id=1
```

#### Toggle Schedule
```
PUT /announcement/api/schedule.php?schedule_id=1
```

## Billboard Display

Access the live billboard display at:
```
http://localhost/announcement/public/display.php
```

### Display Features
- Auto-rotates through active advertisements every 10 seconds
- Shows current display time and update timestamp
- Supports manual navigation (Previous/Next buttons)
- Auto-refreshes page every 60 seconds to check for updates
- Displays only advertisements matching:
  - Current day of the week
  - Current time within display window
  - Active status enabled
  - Schedule dates within range (if specified)

## Directory Structure

```
announcement/
├── api/
│   ├── auth.php           # Authentication endpoints
│   ├── ads.php            # Advertisement management
│   ├── schedule.php       # Schedule management
│   └── upload.php         # Media upload handler
├── config/
│   ├── Database.php       # Database connection
│   └── setup.sql          # Database schema
├── models/
│   ├── User.php           # User model
│   ├── Advertisement.php  # Advertisement model
│   └── Schedule.php       # Schedule model
├── public/
│   ├── index.php          # Login/Register page
│   ├── dashboard.php      # Admin dashboard
│   └── display.php        # Billboard display
├── uploads/               # Media files storage
└── README.md              # This file
```

## Usage Flow

1. **Register/Login** → `index.php`
2. **Create Ads** → `dashboard.php`
3. **View Billboard** → `display.php`

## Example Usage

### Step 1: Register
```bash
curl -X POST http://localhost/announcement/api/auth.php \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "pass123",
    "name": "John Doe",
    "company_name": "Ads Inc"
  }'
```

### Step 2: Login
```bash
curl -X POST http://localhost/announcement/api/auth.php \
  -H "Content-Type: application/json" \
  -c cookies.txt \
  -d '{
    "email": "john@example.com",
    "password": "pass123"
  }'
```

### Step 3: Create Text Advertisement
```bash
curl -X POST http://localhost/announcement/api/ads.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "Welcome to Our Store",
    "ad_type": "text",
    "content": "Opening Soon! Check us out!",
    "start_time": "09:00",
    "end_time": "21:00",
    "days": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    "rotation_order": 1
  }'
```

## Tips & Best Practices

1. **Scheduling**: Set specific time windows for advertisements
2. **Rotation Order**: Lower numbers display first in rotation
3. **Day Scheduling**: Create week-specific promotions
4. **Date Range**: Use optional dates for seasonal campaigns
5. **Media Size**: Optimize images/videos before uploading

## Troubleshooting

### Cannot connect to database
- Check MySQL is running
- Verify credentials in `config/Database.php`
- Ensure database `billboard_db` exists

### Upload fails
- Check `uploads/` folder has write permissions
- Verify file size is under 100MB
- Ensure file type is supported (JPEG, PNG, GIF, MP4)

### No ads showing on display
- Verify ads are marked as Active
- Check current time falls within display time window
- Confirm today's day of week has schedule enabled
- Verify date range (if set) includes today

## Security Considerations

- Passwords are hashed using bcrypt
- Use HTTPS in production
- Validate all file uploads
- Implement rate limiting for API
- Add CSRF token protection
- Consider adding user roles/permissions

## License

This project is open source and available under the MIT License.

## Support

For issues or questions, please contact support or check the documentation.
