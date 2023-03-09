<nav class="header__menu">
    <ul>
        <li class="{{request()->is('home')? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
        <li class="{{request()->is('shop')? 'active' : ''}}"><a href="{{route('shop')}}">Shop</a></li>
        <li>
            <a href="#">Categories</a>
            <ul class="header__menu__dropdown">
                @foreach ($menu_categories as $menu_category)
                    <li>
                        {{-- <a   href="">{{ $menu_category->name }}</a> --}}
                        <a href="{{ route('produk.by.category', $menu_category->id) }}">{{ $menu_category->name }}</a>
                    </li>
                @endforeach

            </ul>
        </li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>
