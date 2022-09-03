@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <h3 class="text-center">{{ __("Order #{$order->id}") }}</h3>
                <hr>
            </div>
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.orders.parts.order_data', ['order' => $order, 'statuses' => $statuses])
                    @include('admin.orders.parts.user_data', ['order' => $order])
                    @include('admin.orders.parts.delivery_data', ['order' => $order])

                    <div class="form-group row">
                        <div class="col-md-10 text-right">
                            <input type="submit" class="btn btn-info" value="Update Order">
                        </div>
                    </div>
                </form>
                <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
            </div>
            <div class="col-md-5">
                @include('admin.orders.parts.summary_table', ['products' => $products])
                @include('admin.orders.parts.taxes', ['order' => $order])
            </div>
        </div>
    </div>
@endsection
