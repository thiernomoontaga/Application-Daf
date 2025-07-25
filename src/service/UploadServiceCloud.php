<?php
namespace Src\Service;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class UploadServiceCloud implements IUploadService
 {

    public function upload(string $path, $options = []): ?string
    {
        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => CLOUDINARY_CLOUD_NAME,
                'api_key'    => CLOUDINARY_API_KEY,
                'api_secret' => CLOUDINARY_API_SECRET
            ],
            'url' => ['secure' => true]
        ]);

        try {
            $uploaded = (new UploadApi())->upload($path, [
                'folder' => 'appdaf',
                'public_id' => uniqid('file_', true),
                'resource_type' => 'auto'
            ]);
        } catch (\Exception $e) {
            error_log('Cloudinary upload error: ' . $e->getMessage());
            return null;
        }
        return $uploaded['secure_url'] ?? null;
    }

}