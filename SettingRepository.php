<?php
namespace App\Repository;

class SettingRepository extends Repository
{
    public function get(string $key, string $default = ''): string
    {
        $stmt = $this->db->prepare('SELECT key_value FROM fw_settings WHERE key_name = ? LIMIT 1');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();

        return $value !== false ? (string) $value : $default;
    }

    public function set(string $key, string $value): bool
    {
        $stmt = $this->db->prepare('INSERT INTO fw_settings (key_name, key_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE key_value = ?');
        return $stmt->execute([$key, $value, $value]);
    }

    public function save(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }
    }
}
