<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

trait ImageTrait
{

    function storeImage(UploadedFile $file, string $path){
        $imageName = "{$this->generateFileName()}.jpg";
        $completePath = base_path() . $path;

        if(!$this->checkDirectory($completePath)){
            mkdir($completePath);
        }

        Image::make($file)->encode('jpg', 70)->save("{$completePath}/{$imageName}");
        return $imageName;
    }

    private function deleteFile(string $file)
    {
        $file = base_path() . $file;
        if (!file_exists($file)) {
            return;
        }
        unlink($file);
    }

    private function checkDirectory(string $dir): bool
    {
        return file_exists($dir);
    }

    private function generateFileName(){
        return $this->gen_uuid();
    }

    private function gen_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}