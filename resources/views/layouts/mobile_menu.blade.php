<nav class="humberger__menu__nav mobile-menu">
    <ul>
        <li class="active"><a href="/">Home</a></li>
        <li><a href="">Shop</a></li>
        <li>
            <a href="#">Categories</a>
            <ul class="header__menu__dropdown">
                @foreach ($menu_categories as $menu_category)
                    <li>
                        <a href="{{ route('produk.by.category', $menu_category->id) }}">{{ $menu_category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="{{request()->is('blog')? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>
