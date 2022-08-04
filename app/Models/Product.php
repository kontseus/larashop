<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
