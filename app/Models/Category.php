<?php

namespace App\Models;

use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
