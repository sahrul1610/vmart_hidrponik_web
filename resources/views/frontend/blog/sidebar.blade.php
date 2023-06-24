@section('css')
    <style>
        .blog__sidebar__recent__item__title {
            display: flex;
            flex-direction: column;
        }

        .blog__sidebar__recent__item__title span {
            margin-top: 5px;
        }
    </style>
@endsection
<div class="blog__sidebar">
    <div class="blog__sidebar__search">
        <form action="#">
            <input type="text" placeholder="Search...">
            <button type="submit"><span class="icon_search"></span></button>
        </form>
    </div>
    <div class="blog__sidebar__item">
        <h4>Categories</h4>
        <ul>
            @foreach ($blog_categories as $kategori)
                <li><a href="{{ route('blog.by.category', $kategori->id) }}">{{ $kategori->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="blog__sidebar__item">
        <h4>Recent News</h4>
        <div class="blog__sidebar__recent">
            @foreach ($blog as $blog)
                <a href="{{ route('blog.detail', ['id' => $blog->id]) }}" class="blog__sidebar__recent__item">
                    <div class="blog__sidebar__recent__item__pic">
                        <img src="{{ asset('storage/images/' . $blog->photo) }}" alt="" width="60"
                            height="60">
                    </div>
                    <div class="blog__sidebar__recent__item__text">
                        <h6 class="blog__sidebar__recent__item__title">{!! $blog->title !!}</h6>
                        <span>{{ \Carbon\Carbon::parse($blog->created_at)->locale('id')->isoFormat('LL') }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    {{-- <div class="blog__sidebar__item">
        <h4>Search By</h4>
        <div class="blog__sidebar__item__tags">
            <a href="#">Apple</a>
            <a href="#">Beauty</a>
            <a href="#">Vegetables</a>
            <a href="#">Fruit</a>
            <a href="#">Healthy Food</a>
            <a href="#">Lifestyle</a>
        </div>
    </div> --}}
</div>
