<?php
namespace App\Service;

use Src\Service\IUploadService;

class UploadServiceLocal {

    // public function upload(string $path, array $options = []): ?string
    // {
    //     $uploadDir = rtrim(UPLOAD_DIR, '/') . '/';
    //     if ($subDir !== '') {
    //         $uploadDir .= trim($subDir, '/') . '/';
    //     }

    //     if (!is_dir($uploadDir)) {
    //         mkdir($uploadDir, 0777, true);
    //     }

    //     if ($file['error'] !== UPLOAD_ERR_OK) {
    //         return null;
    //     }

    //     $filename = uniqid() . '_' . basename($file['name']);
    //     $targetPath = $uploadDir . $filename;

    //     if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    //         error_log("File uploaded successfully: " . $targetPath);
    //         return $targetPath;
    //     }
    //     error_log("Failed to move uploaded file to: " . $targetPath);
    //     return null;
    // }

}