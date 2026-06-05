<?php
namespace App;

class FileUploader
{
    public static function upload(array $file, array $allowedExtensions, string $targetDir, int $maxSize = 0): array
    {
        if (empty($file['name'])) {
            return ['success' => true, 'filename' => null];
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Upload failed. Please try again.'];
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions, true)) {
            return ['success' => false, 'error' => 'Invalid file format.'];
        }

        if ($maxSize > 0 && $file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'File is too large.'];
        }

        if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
            return ['success' => false, 'error' => 'Unable to prepare the upload directory.'];
        }

        $safeName = uniqid('fw_', true) . '.' . $extension;
        $destination = rtrim($targetDir, '/') . '/' . $safeName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return ['success' => false, 'error' => 'Unable to move uploaded file.'];
        }

        return ['success' => true, 'filename' => $safeName];
    }
}
