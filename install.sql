-- ============================================================
--  FreeWatch — install.sql
--  Run this ONCE in phpMyAdmin to create all tables
-- ============================================================

CREATE TABLE IF NOT EXISTS `fw_movies` (
  `id`          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title`       VARCHAR(255)  NOT NULL,
  `genre`       VARCHAR(80)   NOT NULL DEFAULT 'Other',
  `year`        YEAR          DEFAULT NULL,
  `duration`    VARCHAR(20)   DEFAULT NULL,
  `description` TEXT          DEFAULT NULL,
  `video_url`   TEXT          DEFAULT NULL,
  `video_file`  VARCHAR(255)  DEFAULT NULL,
  `thumbnail`   VARCHAR(255)  DEFAULT NULL,
  `views`       INT UNSIGNED  NOT NULL DEFAULT 0,
  `featured`    TINYINT(1)    NOT NULL DEFAULT 0,
  `created_at`  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `fw_messages` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(120) NOT NULL,
  `contact`    VARCHAR(120) DEFAULT NULL,
  `message`    TEXT         NOT NULL,
  `is_read`    TINYINT(1)   NOT NULL DEFAULT 0,
  `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `fw_settings` (
  `key_name`   VARCHAR(80) PRIMARY KEY,
  `key_value`  TEXT        DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default settings
INSERT IGNORE INTO `fw_settings` (`key_name`, `key_value`) VALUES
  ('admin_username',  'admin'),
  ('admin_password',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),  -- password: password
  ('wa_number',       '255700000000'),
  ('channel_url',     'https://pauloflix.online'),
  ('site_description','Watch the latest movies online for free');

-- Sample movie
INSERT INTO `fw_movies` (`title`,`genre`,`year`,`description`,`featured`) VALUES
  ('Demo Movie','Action',2024,'This is a sample movie. Upload real movies from the admin panel.',1);
