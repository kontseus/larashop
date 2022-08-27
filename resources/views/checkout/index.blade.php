@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Checkout') }}</h3>
                @if ($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif
            </div>
            <div class="col-md-8">
                {{--                <form id="order-form" action="{{ route('order.create') }}" method="POST">--}}
                <form id="order-form" action="#" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth()->user()->name }}" autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ Auth()->user()->surname }}" autocomplete="surname" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth()->user()->email }}" autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth()->user()->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                        <div class="col-md-6">
                            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <table class="table table-light">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Cart::instance('cart')->content() as $cartItem)
                        <tr>
                            <td>
                                <img src="{{ $cartItem->model->thumbnailUrl }}" alt="{{ $cartItem->name }}" style="width: 50px;">
                            </td>
                            <td>
                                <a href="{{ route('products.show', $cartItem->id) }}"><strong>{{ $cartItem->name }}</strong></a>
                            </td>
                            <td>{{ $cartItem->qty }}</td>
                            <td>{{ $cartItem->price }}$</td>
                            <td>{{ $cartItem->subtotal }}$</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <table class="table table-dark">
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
                <br>
                <div class="col-12">
                    @include('checkout.payments.paypal')
                </div>
            </div>
        </div>
    </div>
@endsection
