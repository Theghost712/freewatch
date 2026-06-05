<?php
// Database and application configuration

define('DB_HOST', 'localhost');
define('DB_NAME', 'freewatch');   // <-- change to your database name
define('DB_USER', 'root');      // <-- change to your database username
define('DB_PASS', '');          // <-- change to your database password

define('SITE_NAME', 'FreeWatch');
define('SITE_URL', 'https://yourdomain.com');

define('WA_NUMBER', '255747433510');
define('CHANNEL_URL', 'https://pauloflix.com');

define('UPLOAD_VIDEO_DIR', __DIR__ . '/../uploads/movies');
define('UPLOAD_THUMB_DIR', __DIR__ . '/../uploads/thumbnails');
define('MAX_VIDEO_SIZE', 500 * 1024 * 1024);
define('ALLOWED_VIDEO_EXTENSIONS', ['mp4', 'webm', 'mkv', 'avi', 'mov']);
define('ALLOWED_IMAGE_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);
