<?php

namespace App\Repositories;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\ImagesService;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryContract
{
    public function create(CreateProductRequest $request): Product|bool
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $images = $data['images'] ?? [];
            $category = Category::find($data['category']);
            $product = $category->products()->create($data); // category_id
            ImagesService::attach($product, 'images', $images);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return false;
        }
    }

    public function update(Product $product, UpdateProductRequest $request): bool
    {
        try {
            DB::beginTransaction();
            $product->update($request->validated());

            ImagesService::attach($product, 'images', $request->images ?? []);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return false;
        }
    }
}
