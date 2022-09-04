@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Orders') }}</h3>
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
                        <th class="text-center" scope="col">User</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Created At</th>
                        {{--                        <th class="text-center" scope="col">@sortablelink('status_id', 'Status')</th>--}}
                        {{--                        <th class="text-center" scope="col">@sortablelink('created_at', 'Created At')</th>--}}
                        {{--                        <th class="text-center" scope="col" style="padding: 0.5rem;">@sortablelink('total', 'Total Price')</th>--}}
                        <th class="text-center" scope="col" style="padding: 0.5rem;">Total Price</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-center" scope="col">{{ $order->id }}</td>
                            <td class="text-center">{{ $order->user->fullName }}</td>
                            <td class="text-center">{{ $order->email }}</td>
                            <td class="text-center" scope="col">{{ $order->status->name }}</td>
                            <td class="text-center" scope="col">{{ $order->created_at }}</td>
                            <td class="text-center" scope="col">{{ __($order->total . '$') }}</td>
                            <td class="text-center" scope="col">
                                <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('orders.generate.invoice', $order) }}" class="btn btn-success">Invoice</a>
                                <a href="" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
