@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Category "'. $category->name .'"') }}</h3>
                <hr>
                <p class="text-center">{{ $category->description }}</p>
            </div>
            <div class="col-md-12">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            @if($products->count() === 0)
                                <div class="col-12">
                                    <h1 class="text-center">
                                        There are no products yet
                                    </h1>
                                </div>
                            @else
                                @each('products.parts.product_view', $products, 'product')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
