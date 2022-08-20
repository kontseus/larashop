<div class="col-md-4">
    <div class="card mb-4 shadow-sm">
        @if(Storage::has($product->thumbnail))
            <img src="{{ Storage::url($product->thumbnail) }}" height="400" class="card-img-top"
                 style="max-width: 100%; margin: 0 auto; display: block;">
        @endif
        <div class="card-body">
            <p class="card-title">{{ __($product->title) }}</p>
            <hr>
            <p class="card-text">{{ __($product->short_description) }}</p>
            <div class="d-flex flex-column justify-content-center align-items-start">
                <small class="text-muted">Categories: </small>
                <div class="btn-group align-self-end">
                    @if(!empty($product->category))
                        @include('categories.parts.category_view', ['category' => $product->category])
                    @endif
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('products.show', $product->id) }}"
                       class="btn btn-sm btn-outline-dark">
                        {{ __('Show') }}
                    </a>
                </div>
                <span class="text-muted">{{ $product->end_price }}$</span>
            </div>
        </div>
    </div>
</div>
