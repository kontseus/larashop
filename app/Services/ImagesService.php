<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class ImagesService implements Contracts\ImagesServiceContract
{

    public static function attach(Model $model, string $methodName, array $images = [])
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception($model::class . " doesn't have {$methodName}");
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                call_user_func([$model, $methodName])->create(['path' => $image]);
            }
        }
    }
}
