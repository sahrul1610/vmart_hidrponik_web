<div class="sidebar">
    <div class="sidebar__item">
    <h4>Categories</h4>
    <ul>
        @foreach($menu_categories as $menu_category)
        <li>
            <a href="{{ route('produk.by.category', $menu_category->id) }}">{{ $menu_category->name }}</a>
        </li>
        @endforeach
    </ul>
    </div>
    <div class="sidebar__item">
    <h4>Tags</h4>
    {{-- @foreach($menu_tags as $menu_tag)
    <div class="sidebar__item__size">
        <label for="large">
        <a href="{{ route('shop.tag', $menu_tag->slug) }}">{{ $menu_tag->name }}</a>
        </label>
    </div>
    @endforeach --}}
    </div>
</div>
