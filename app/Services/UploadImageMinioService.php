<?php
namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class  UploadImageMinioService implements UploadImageService{
    protected string $disk = 'minio';
    

    public function exists(string $public_id):bool{
        return Storage::disk($this->disk)->exists($public_id);
    }

    public function deleteImage(string $public_id):bool{
        return Storage::disk($this->disk)->delete($public_id);
    }

    public function updateImage(?string $public_id, UploadedFile $file): array{
        if($public_id){
            $this->deleteImage($public_id);
        }
        return $this->saveImage($file);
    }

    public function saveImage(UploadedFile $file): array{
        $fileName = Str::uuid() . "." . $file->getClientOriginalExtension();
        $path = Storage::disk($this->disk)->putFileAs(
            '',
            $file,
            $fileName
        );

        return [
            'url'=>  Storage::disk($this->disk)->url($path),
            'public_id' =>  $path
        ];
    }
}