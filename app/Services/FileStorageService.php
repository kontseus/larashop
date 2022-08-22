<?php

namespace App\Services;

use App\Services\Contracts\FileStorageServiceContract;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService extends Facade implements FileStorageServiceContract
{

    public static function upload(UploadedFile|string $file): string
    {
        if (is_string($file)) {
            return str_replace('public/storage', '', $file);
        }

        $filePath = 'public/' . static::randomName() . '.' . $file->getClientOriginalExtension();

        Storage::put($filePath, File::get($file));

        return $filePath;
    }

    public static function remove(string $file)
    {
        Storage::delete($file);
    }

    protected static function randomName(): string
    {
        return Str::random() . '_' . time();
    }
}
