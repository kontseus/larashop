@extends('layouts.app')

@section('content')
    @include('account.parts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Order #' . $order->id) }}</h3>
            </div>
            <div class="col-md-12">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-self-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col"> Name</th>
                                        <th class="text-center" scope="col"> Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Status')}}</td>
                                        <td class="text-center"> {{ $order->status->name }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Name')}}</td>
                                        <td class="text-center"> {{ $order->name }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Surname')}}</td>
                                        <td class="text-center"> {{ $order->surname }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('E-Mail')}}</td>
                                        <td class="text-center"> {{ $order->email }} </td>
                                    </tr>
                                    <tr>
                                        <td><h3 class="text-center">Billing Data</h3></td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Country')}}</td>
                                        <td class="text-center"> {{ $order->country }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('City')}}</td>
                                        <td class="text-center"> {{ $order->city }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Address')}}</td>
                                        <td class="text-center"> {{ $order->address }} </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-center" scope="col"> Total:</th>
                                        <th class="text-center" scope="col"> {{ $order->total }}$</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                @if(!$order->is_completed && !$order->is_canceled)
                                    <form method="POST" class="w-100 text-right"
                                          action="{{ route('account.orders.cancel', $order) }}">
                                        @csrf
                                        <input type="submit" class="btn btn-outline-danger" value="Cancel order"/>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
