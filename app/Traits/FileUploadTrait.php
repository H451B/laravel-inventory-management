<?php

namespace App\Trait;

use File;
use Image;

trait FileUploadTrait{
    public function uploadFile($file, $folder, $height=null, $width=null){
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

        if (strpos($file->getMimeType(), 'image') !== false) {
            $image = 'Image'::make($file);

            // Check if both height and width are provided for resizing
            if ($height && $width) {
                $image->resize($width, $height);
            }

            $image->save(storage_path($folder) . '/' . $fileName);
        } else {
            $file->move(storage_path($folder), $fileName);
        }

        return $fileName;
    }
}