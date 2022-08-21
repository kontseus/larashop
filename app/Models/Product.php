<?php

namespace App\Models;

use App\Services\FileStorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use willvincent\Rateable\Rateable;

class Product extends Model
{
    use HasFactory, Rateable;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'short_description',
        'price',
        'discount',
        'thumbnail',
        'in_stock',
        'SKU'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'wish_list',
            'product_id',
            'user_id'
        );
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

    public function endPrice() : Attribute
    {
        return new Attribute(
            get: function() {
                $price = is_null($this->attributes['discount'])
                    ? $this->attributes['price']
                    : ($this->attributes['price'] - ($this->attributes['price'] * ($this->attributes['discount'] / 100)));

                return $price < 0 ? 0 : round($price, 2);
            }
        );
    }

    public function getUserRating()
    {
        $ratings = $this->ratings()->where('rateable_id', $this->id)->get();

        return $ratings->where('user_id', auth()->id())->first();
    }
}
