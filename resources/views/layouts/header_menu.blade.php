<nav class="header__menu">
    <ul>
        <li class="active"><a href="/">Home</a></li>
        <li><a href=" ">Shop</a></li>
        <li>
            <a href="#">Categories</a>
            <ul class="header__menu__dropdown">
                {{-- @foreach ($menu_categories as $menu_category)
                    <li><a
                            href="{{ route('shop.index', $menu_category->slug) }}">{{ $menu_category->name }}</a>
                    </li>
                @endforeach --}}
                bjjjjjjj
            </ul>
        </li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>
