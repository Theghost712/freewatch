<?php
namespace App\Controller;

use App\View;

abstract class BaseController
{
    protected function render(string $view, array $params = []): void
    {
        View::render($view, $params);
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    protected function post(string $key, string $default = ''): string
    {
        return trim($_POST[$key] ?? $default);
    }

    protected function get(string $key, string $default = ''): string
    {
        return trim($_GET[$key] ?? $default);
    }
}
