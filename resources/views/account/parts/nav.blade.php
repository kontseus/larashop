<nav class="navba navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.edit', Auth()->user()) }}">{{ __('Edit Profile') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.wishlist') }}">{{ __('WishList') }}</a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="{{ route('account.orders.list') }}">{{ __('My orders') }}</a>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
