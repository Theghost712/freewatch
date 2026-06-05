<?php
namespace App;

class View
{
    public static function render(string $template, array $params = []): void
    {
        extract($params, EXTR_SKIP);
        $viewFile = __DIR__ . "/../../views/" . $template;

        if (!file_exists($viewFile)) {
            throw new \RuntimeException('View template not found: ' . $viewFile);
        }

        require $viewFile;
    }
}
