<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

interface UploadImageService {
    
    public function exists(string $path): bool;

    public function deleteImage(string $public_id): bool;

    public function updateImage(?string $public_id, UploadedFile $file): array; 

    public function saveImage(UploadedFile $file): array;
}