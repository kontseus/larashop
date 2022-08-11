<?php

namespace App\Models;

use App\Services\FileStorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'short_description',
        'price',
        'discount',
        'thumbnail',
        'in_stock',
        'SKU',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function available(): Attribute
    {
        return new Attribute(
            get: fn() => $this->attributes['in_stock'] > 0
        );
    }

    public function setThumbnailAttribute($image)
    {
        if (!empty($this->attributes['thumbnail'])) {
            FileStorageService::remove($this->attributes['thumbnail']);
        }

        $this->attributes['thumbnail'] = FileStorageService::upload($image);
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(get: fn() => Storage::url($this->attributes['thumbnail']));
    }

}
