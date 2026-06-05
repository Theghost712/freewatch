<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = \App\Database::getInstance()->getConnection();

function e(string $value): string {
    return \App\Helper::escape($value);
}

function format_views(int $value): string {
    return \App\Helper::formatViews($value);
}

function time_ago(string $datetime): string {
    return \App\Helper::timeAgo($datetime);
}

