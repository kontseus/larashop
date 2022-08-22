@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Products') }}</h3>
            </div>
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <table class="table align-self-center">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Thumbnail</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-center" scope="col">{{ $product->id }}</td>
                            <td class="text-center" scope="col"><img src="{{ $product->thumbnailUrl }}" width="100" height="100" alt=""></td>
                            <td class="text-center" scope="col">{{ $product->title }}</td>
                            <td class="text-center" scope="col">{{ $product->in_stock }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
