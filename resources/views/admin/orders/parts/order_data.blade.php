<div class="col">
    <h3 class="text-center">{{ __('Order Information') }}</h3>
</div>

<div class="form-group row">
    <label for="total_price" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>
    <div class="col-md-6">
        <input id="total_price" type="text" class="form-control" value="{{ $order->total }}" disabled>
    </div>
</div>

<div class="form-group row">
    <label for="order_status" class="col-md-4 col-form-label text-md-right">{{ __('Order Status') }}</label>
    <div class="col-md-6">
        <select name="status_id" id="order_status" class="form-control">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}"
                    {{ ($status->id === $order->status_id ? 'selected' : '') }}
                >{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
</div>
