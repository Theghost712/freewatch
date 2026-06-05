<?php
namespace App;

use App\Repository\SettingRepository;

class Auth
{
    public static function login(string $user, string $pass): bool
    {
        $settings = new SettingRepository();
        $dbUser = $settings->get('admin_username', 'admin');
        $dbHash = $settings->get('admin_password', '');

        if ($user === $dbUser && password_verify($pass, $dbHash)) {
            $_SESSION['fw_admin'] = true;
            session_regenerate_id(true);
            return true;
        }

        return false;
    }

    public static function isAdmin(): bool
    {
        return isset($_SESSION['fw_admin']) && $_SESSION['fw_admin'] === true;
    }

    public static function requireAdmin(): void
    {
        if (!self::isAdmin()) {
            header('Location: login.php');
            exit;
        }
    }

    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        session_destroy();
    }
}
