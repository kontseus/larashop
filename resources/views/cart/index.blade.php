@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Cart') }}</h3>
            </div>
            <div class="col-md-12">
                @if(Cart::instance('cart')->count() > 0)
                    <table class="table table-light">
                        <thead>
                        <tr>
                            <th colspan="2">Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>

                        <tbody>

                        @each('cart.parts.product_view', Cart::instance('cart')->content(), 'row')

                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">There are no products in cart</h3>
                @endif
                <hr>
                <table class="table table-dark" style="width: 50%; float: right;">
                    <tbody>
                    <tr>
                        <td colspan="2">&nbsp</td>
                        <td>Subtotal</td>
                        <td>{{ Cart::subtotal() }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp</td>
                        <td>Tax</td>
                        <td>{{ Cart::tax() }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp</td>
                        <td>Total</td>
                        <td>{{ Cart::total() }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            @auth
                <div class="col-md-12 text-right">
                    <a href="{{ route('checkout') }}" class="btn btn-outline-success">{{ __('Proceed to checkout') }}</a>
                </div>
            @endauth
        </div>
    </div>
@endsection
