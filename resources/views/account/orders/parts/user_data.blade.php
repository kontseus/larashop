<div class="col">
    <h3 class="text-center">{{ __('User Information') }}</h3>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $order->name }}" autocomplete="name" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
    <div class="col-md-6">
        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $order->surname }}" autocomplete="surname" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $order->email }}" autocomplete="email">
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

    <div class="col-md-6">
        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $order->phone }}">
    </div>
</div>
