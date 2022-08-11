<?php

namespace App\Services;

use App\Services\Contracts\FileStorageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService implements FileStorageServiceContract
{

    public static function upload(string|UploadedFile $file): string
    {
        if (is_string($file)) {
            return str_repeat('public/storage', '', $file);
        }

        $filepath = 'public/' . static::randomName() . '.' . $file->getClientOriginalExtension();

        Storage::put($filepath, File::get($file));

        return $filepath;
    }

    public static function remove(string $file)
    {

    }

    protected static function randomName(): string
    {
        return Str::random() . '_' . time();
    }
}
