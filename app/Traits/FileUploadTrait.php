<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;


trait FileUploadTrait
{
    public function uploadFile($file, $path, $height = null, $width = null)
    {
        if ($file) {
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            // Check if the file is an image
            if (strpos($file->getMimeType(), 'image') !== false) {
                $image = 'Image'::make($file);

                // Check if both height and width are provided for resizing
                if ($height && $width) {
                    $image->resize($width, $height);
                }

                $image->save(storage_path($path) . '/' . $filename);
            } else {
                $file->move(storage_path($path), $filename);
            }

            return $filename;
        }
    }


    public function deleteFile($path)
    {
        if (storage_path('app/public/'.$path)) {
            unlink(storage_path('app/public/'.$path));
        }

        return true;
    }
}

