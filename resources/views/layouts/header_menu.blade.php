<nav class="header__menu">
    <ul>
        <li class="{{request()->is('home')? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
        <li class="{{request()->is('shop')? 'active' : ''}}"><a href="{{route('shop')}}">Shop</a></li>
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
        <li><a href="#about">Contact</a></li>
    </ul>
</nav>
