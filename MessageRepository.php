<?php
namespace App\Repository;

class MessageRepository extends Repository
{
    public function count(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM fw_messages');
        return (int) $stmt->fetchColumn();
    }

    public function countUnread(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM fw_messages WHERE is_read = 0');
        return (int) $stmt->fetchColumn();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM fw_messages ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function save(string $name, string $contact, string $message): bool
    {
        $stmt = $this->db->prepare('INSERT INTO fw_messages (name, contact, message) VALUES (?, ?, ?)');
        return $stmt->execute([$name, $contact, $message]);
    }

    public function markAllRead(): void
    {
        $this->db->query('UPDATE fw_messages SET is_read = 1');
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM fw_messages WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
