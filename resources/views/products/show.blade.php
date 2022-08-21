@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center">{{ __($product->title) }}</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            @if(Storage::has($product->thumbnail))
                <img src="{{ $product->thumbnailUrl }}" class="card-img-top"
                     style="width: 200px; height: 300px; margin: 0 auto; display: block;">
            @endif
        </div>
        <div class="col-md-6">
            <p>Price: {{ $product->end_price }}$</p>
            <p>SKU: {{ $product->SKU }}</p>
            <p>In stock: {{ $product->in_stock }}</p>
            <p>Rating: {{ round($product->averageRating(), 2) }}</p>
            <hr>
            <div>
                <p>Product Category: <b> @include('categories.parts.category_view', ['category' => $product->category])</b></p>
            </div>
            @if($product->in_stock > 0)
                <hr>
                <div>
                    <p>Add to Cart: </p>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="form-inline">
                        @csrf
                        @method('post')
                        <div class="form-group col-sm-3 mb-2">
                            <label for="product_count" class="sr-only">Count: </label>
                            <input type="number"
                                   name="product_count"
                                   class="form-control"
                                   id="product_count"
                                   min="1"
                                   max="{{ $product->in_stock }}"
                                   value="1"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Buy</button>
                    </form>
                </div>
            @endif
            @auth
                <form class="form-horizontal poststars" action="{{ route('product.rating.add', $product) }}" id="addStar"
                      method="POST">
                    @csrf
                    <div class="form-group required">
                        <div class="col-sm-3 stars">
                            @if(!is_null($userRating))
                                @for($i = 5; $i >= 1; $i--)
                                    <input class="star star-{{$i}}"
                                           value="{{$i}}"
                                           id="star-{{$i}}"
                                           type="radio"
                                           name="star"
                                        {{
                                        $i == $userRating->rating
                                        ? 'checked'
                                        : ''
                                        }}
                                    />
                                    <label class="star star-{{$i}}" for="star-{{$i}}"></label>
                                @endfor
                            @else
                                <input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
                                <label class="star star-1" for="star-1"></label>
                            @endif
                        </div>
                    </div>
                </form>
                <hr>
                @if(is_user_followed($product))
                    <form action="{{ route('wishlist.delete', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Remove from Wish List">
                    </form>
                @else
                    <a href="{{ route('wishlist.add', $product) }}"
                       class="btn btn-success">{{ __('Add to Wish List') }}</a>
                @endif
            @endauth
        </div>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="col-md-10 text-center">
            <h4>Description: </h4>
            <p>{{ $product->description }}</p>
        </div>
    </div>
    <hr>
    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-12 text-center">--}}
    {{--                <h4>Comments</h4>--}}
    {{--            </div>--}}
    {{--            <br>--}}
    {{--            <div class="row">--}}
    {{--                @foreach($product->comments as $comment)--}}
    {{--                    @include('comments/_single_comment', ['comment' => $comment, 'model' => $product])--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-12 d-flex flex-column justify-content-center align-items-center">--}}
    {{--                <br>--}}
    {{--                @include('comments/_form', ['model' => $product])--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
@push('footer-scripts')
    @vite(['resources/js/product-actions.js'])
@endpush
