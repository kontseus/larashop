<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Contracts\FileStorageServiceContract;
use App\Services\FileStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('category')->paginate(5);

        return view('admin/products/index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/products/create', compact('categories'));
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();
        FileStorageService::upload($data['thumbnail']);
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $category = Category::find($data['category']);
            $product = $category->products()->create($data); // category_id

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('status', "The product #{$product->id} was successfully created!");
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);

            return redirect()->back()->with('warn', 'Oops smth wrong. See logs');
        }
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        //
//    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }
}
