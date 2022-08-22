@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Wish List') }}</h3>
            </div>
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                @if(Cart::instance('wishlist')->count() > 0)
                    <table class="table table-light">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Old Price</th>
                            <th>Current Price</th>
                            <th>Available</th>
                            <th>Remove</th>
                        </tr>
                        </thead>

                        <tbody>
                        @each(
                            'account.wishlist.parts.product_view',
                            Cart::instance('wishlist')->content(),
                            'row'
                        )
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">There are no products in your wish list</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
