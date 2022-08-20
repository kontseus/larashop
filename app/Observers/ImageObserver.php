<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\FileStorageService;

class ImageObserver
{
    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        FileStorageService::remove($image->path);
    }
}
