<?php

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    //  $PRODUCT_FILE_DIR = '/storage/app/public/products';

    function storeImage(UploadedFile $file, string $path){
        $imageName = $this->generateFileName();
        Image::make($file)->encode('jpg', 70)->save($path . $imageName);
        return $imageName;
    }

    function deleteFile(string $file)
    {
        $file = base_path() . $file;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    private function checkDirectory(string $dir): bool
    {
        if (file_exists($dir)) {
            return true;
        }
        return false;
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