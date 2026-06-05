<?php
namespace App;

class Helper
{
    public static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function formatViews(int $value): string
    {
        if ($value >= 1000000) {
            return round($value / 1000000, 1) . 'M';
        }

        if ($value >= 1000) {
            return round($value / 1000, 1) . 'K';
        }

        return (string) $value;
    }

    public static function timeAgo(string $datetime): string
    {
        $diff = time() - strtotime($datetime);

        if ($diff < 60) {
            return $diff . 's ago';
        }

        if ($diff < 3600) {
            return floor($diff / 60) . 'm ago';
        }

        if ($diff < 86400) {
            return floor($diff / 3600) . 'h ago';
        }

        return floor($diff / 86400) . 'd ago';
    }

    public static function normalizePhone(string $number): string
    {
        return preg_replace('/[^0-9]/', '', $number);
    }
}
