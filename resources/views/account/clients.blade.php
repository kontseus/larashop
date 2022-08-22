@extends('layouts.app')

@section('content')
    @include('account.orders.parts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <h3 class="text-center">{{ __('Clients') }}</h3>
                <br>
            </div>
            <div class="col-md-12">
                @foreach($clients as $client)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $client->name }}</h5>
                            <div class="card-text">
                                <ul>
                                    <li>id - {{ $client->id }}</li>
                                    <li>redirect - {{ $client->redirect }}</li>
                                    <li>secret - {{ $client->secret }}</li>
                                    <li>provider - {{ $client->provider }}</li>
                                    <li>personal_access_client - {{ $client->personal_access_client }}</li>
                                    <li>password_client - {{ $client->password_client }}</li>
                                    <li>revoked - {{ $client->revoked }}</li>
                                </ul>
                                <a href="{{ route('account.authorize', $client->id) }}" class="btn btn-outline-primary">Authorize</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12">
                <form action="{{ route('passport.clients.store') }}" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="Client Name" class="form-control mb-4"/>
                    <input type="text" name="redirect" placeholder="http://localhost../callback"
                           class="form-control mb-4"/>

                    <input type="submit" class="btn btn-outline-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
