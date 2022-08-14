<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface ImagesServiceContract
{
    public static function attach(Model $model, string $methodName, array $images = []);
}
