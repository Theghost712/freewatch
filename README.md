# FreeWatch — Setup Instructions

## Folder Structure
```
freewatch/
├── index.php              ← Main user-facing homepage
├── .htaccess
├── install.sql            ← Run this in phpMyAdmin FIRST
├── includes/
│   ├── db.php             ← Database config (EDIT THIS)
│   └── .htaccess
├── admin/
│   ├── index.php          ← Admin dashboard
│   ├── login.php          ← Admin login
│   └── logout.php
├── api/
│   └── view.php           ← View counter (AJAX)
└── uploads/
    ├── movies/            ← Uploaded video files
    ├── thumbnails/        ← Uploaded poster images
    └── .htaccess
```

---

## Step 1 — Create Database
1. Go to InfinityFree cPanel → MySQL Databases
2. Create a new database
3. Create a database user and assign to the database (ALL PRIVILEGES)
4. Open phpMyAdmin, select your database
5. Click "SQL" tab, paste the contents of `install.sql` and click Go

---

## Step 2 — Edit db.php
Open `includes/db.php` and fill in:
```php
define('DB_HOST', 'localhost');           // usually localhost
define('DB_NAME', 'if0_XXXXXX_yourdb');  // your database name
define('DB_USER', 'if0_XXXXXX');         // your database username  
define('DB_PASS', 'yourpassword');        // your database password
define('SITE_URL', 'https://yourdomain.infinityfreeapp.com');
define('WA_NUMBER', '255712345678');      // your WhatsApp number (no +)
define('CHANNEL_URL', 'https://pauloflix.com');
```

---

## Step 3 — Upload Files
Upload the entire `freewatch/` folder to your InfinityFree `htdocs/` directory.
Structure should be:
```
htdocs/
├── index.php
├── admin/
├── api/
├── includes/
└── uploads/
```

---

## Step 4 — Set Folder Permissions
In InfinityFree File Manager, right-click each uploads folder and set permissions to **755**:
- `uploads/`
- `uploads/movies/`
- `uploads/thumbnails/`

---

## Step 5 — Admin Login
- URL: `yourdomain.com/admin/login.php`
- Default username: `admin`
- Default password: `password`
- **Change these immediately** in Admin → Settings!

---

## InfinityFree Notes
- No `session_regenerate_id()` — already excluded
- No IP checks — already excluded
- Max upload size on free hosting: ~10MB via PHP. For larger movies, use the **Video URL** field (paste a direct MP4 link or YouTube embed)
- For large video hosting: use Google Drive, Mega, or any direct MP4 link

---

## Default Admin Password
The `install.sql` sets the default password hash for `password`.
After first login, go to Settings and change it immediately.
