<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ __('Products') }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('admin.products.index') }}">
            {{ __('All products') }}
        </a>
        <a class="dropdown-item" href="{{ route('admin.products.create') }}">
            {{ __('Create product') }}
        </a>
    </div>
</li>
