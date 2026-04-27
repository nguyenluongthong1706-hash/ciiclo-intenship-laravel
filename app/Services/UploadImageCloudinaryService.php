<?php
namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile; 

class  UploadImageCloudinaryService implements UploadImageService{
    protected Cloudinary $cloudinary;

    public function __construct(){
        $this->cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
    } // cloudinary has 3 api: adminApi(meta data), updateApi(upload, destroy(public_id not path) and update), and  URL / Transformation API

    public function exists(string $public_id):bool{
        try{
            $result = $this->cloudinary->adminApi()->asset($public_id);
            return true;
        }
        catch(\Exception $e){
            return false;
        }
    }

    public function deleteImage(string $public_id):bool{
        try{
            $result = $this->cloudinary->uploadApi()->destroy($public_id);
            return ($result['result'] ?? '') === 'ok'; // response ['result' => 'ok'] || ['result' => 'not found']
        }
        catch(\Exception $e){
            report($e);
            return false;
        }
    }

    public function updateImage(?string $public_id, UploadedFile $file): array{
        if($public_id){
            $this->deleteImage($public_id);
        }
        return $this->saveImage($file);
    }

    public function saveImage(UploadedFile $file): array{
        $result = $this->cloudinary->uploadApi()->upload($file->getRealPath(),['folder'=>'uploads']);
        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id']
        ];
    }
}