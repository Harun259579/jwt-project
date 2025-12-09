<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function fileUpload($file, $folder, $oldFile = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(20) . '_' . time() . '.' . $extension;

        $uploadPath = 'uploads/' . $folder;

        if (!file_exists(public_path($uploadPath))) {
            mkdir(public_path($uploadPath), 0777, true);
        }

        $file->move(public_path($uploadPath), $filename);

        return $uploadPath . '/' . $filename;
    }
}
