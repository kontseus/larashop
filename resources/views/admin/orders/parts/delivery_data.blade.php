<div class="col">
    <h3 class="text-center">{{ __('Delivery Information') }}</h3>
</div>
<div class="form-group row">
    <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

    <div class="col-md-6">
        <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $order->country }}">
    </div>
</div>

<div class="form-group row">
    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

    <div class="col-md-6">
        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $order->city }}">
    </div>
</div>
<div class="form-group row">
    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

    <div class="col-md-6">
        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $order->address }}">
    </div>
</div>
