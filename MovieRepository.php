<?php
namespace App\Repository;

class MovieRepository extends Repository
{
    public function getFeatured(): ?array
    {
        $stmt = $this->db->query('SELECT * FROM fw_movies WHERE featured = 1 ORDER BY created_at DESC LIMIT 1');
        $featured = $stmt->fetch();

        if ($featured) {
            return $featured;
        }

        $stmt = $this->db->query('SELECT * FROM fw_movies ORDER BY views DESC LIMIT 1');
        return $stmt->fetch() ?: null;
    }

    public function getMovies(string $genre = '', string $search = ''): array
    {
        $params = [];
        $where = [];

        if ($genre !== '') {
            $where[] = 'genre = :genre';
            $params[':genre'] = $genre;
        }

        if ($search !== '') {
            $where[] = '(title LIKE :search OR description LIKE :search2)';
            $params[':search']  = '%' . $search . '%';
            $params[':search2'] = '%' . $search . '%';
        }

        $sql = 'SELECT * FROM fw_movies' . ($where ? ' WHERE ' . implode(' AND ', $where) : '') . ' ORDER BY created_at DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getGenres(): array
    {
        $stmt = $this->db->query('SELECT DISTINCT genre FROM fw_movies ORDER BY genre');
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getTotalViews(): int
    {
        $stmt = $this->db->query('SELECT COALESCE(SUM(views), 0) FROM fw_movies');
        return (int) $stmt->fetchColumn();
    }

    public function countMovies(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM fw_movies');
        return (int) $stmt->fetchColumn();
    }

    public function getTopMovies(int $limit = 8): array
    {
        $stmt = $this->db->prepare('SELECT * FROM fw_movies ORDER BY views DESC LIMIT ?');
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGenreStats(): array
    {
        $stmt = $this->db->query('SELECT genre, COUNT(*) AS cnt, SUM(views) AS views FROM fw_movies GROUP BY genre ORDER BY views DESC');
        return $stmt->fetchAll();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO fw_movies (title, genre, year, duration, description, video_url, video_file, thumbnail, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );

        $stmt->execute([
            $data['title'],
            $data['genre'],
            $data['year'] ?: null,
            $data['duration'],
            $data['description'],
            $data['video_url'] ?? null,
            $data['video_file'] ?? null,
            $data['thumbnail'] ?? null,
            $data['featured'] ? 1 : 0,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function delete(int $id): bool
    {
        $movie = $this->findById($id);

        if (!$movie) {
            return false;
        }

        if ($movie['video_file'] && file_exists(UPLOAD_VIDEO_DIR . '/' . $movie['video_file'])) {
            @unlink(UPLOAD_VIDEO_DIR . '/' . $movie['video_file']);
        }

        if ($movie['thumbnail'] && file_exists(UPLOAD_THUMB_DIR . '/' . $movie['thumbnail'])) {
            @unlink(UPLOAD_THUMB_DIR . '/' . $movie['thumbnail']);
        }

        $stmt = $this->db->prepare('DELETE FROM fw_movies WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM fw_movies WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function setFeatured(int $id): void
    {
        $this->db->query('UPDATE fw_movies SET featured = 0');
        $stmt = $this->db->prepare('UPDATE fw_movies SET featured = 1 WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function incrementViews(int $id): bool
    {
        $stmt = $this->db->prepare('UPDATE fw_movies SET views = views + 1 WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
