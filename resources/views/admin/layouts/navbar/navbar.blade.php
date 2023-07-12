<ul>
    <li class="{{request()->is('dashboard')? 'active' : ''}}">
        <a href="{{url('/dashboard')}}" class="link">
            <i class="ti-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ request()->is('kategori','produk')? 'active open' : '' }}">
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-shopping-cart"></i>
            <span>Produk</span>
        </a>
        {{-- <ul class="{{ request()->is('kategori')? 'sub-menu expand' : '' }}" > --}}
        <ul class="sub-menu {{ request()->is('kategori','produk')? 'expand' : '' }}">
            <li class="{{ request()->is('produk')? 'active' : '' }}"><a href="{{url('/produk')}}"><span>Produk</span></a></li>
            <li class="{{ request()->is('kategori')? 'active' : '' }}"> <a href="{{url('/kategori')}}" class="link"><span>Kategori</span></a></li>
        </ul>
    </li>

    <li class="{{ request()->is('pengguna')? 'active' : '' }}">
        <a href="{{url('/pengguna')}}" class="link">
            <i class="ti-user"></i>
            <span>Pengguna</span>
        </a>
    </li>
    <li class="{{ request()->is('posts/kategori','posts')? 'active open' : '' }}">
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-desktop"></i>
            <span>Blog</span>
        </a>
        {{-- <ul class="{{ request()->is('kategori')? 'sub-menu expand' : '' }}" > --}}
        <ul class="sub-menu {{ request()->is('posts/kategori','posts')? 'expand' : '' }}">
            <li class="{{ request()->is('posts/kategori')? 'active' : '' }}"><a href="{{url('/posts/kategori')}}"><span>Blog Kategori</span></a></li>
            <li class="{{ request()->is('posts')? 'active' : '' }}"><a href="{{url('/posts')}}"><span>Blog</span></a></li>

        </ul>
    </li>
    <li class="{{ request()->is('transaksi/pesanan','transaksi/transaksi', 'transaksi/selesai')? 'active open' : '' }}">
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-reload"></i>
            <span>Transaksi</span>
        </a>
        {{-- <ul class="{{ request()->is('kategori')? 'sub-menu expand' : '' }}" > --}}
        <ul class="sub-menu {{ request()->is('transaksi/pesanan','transaksi/transaksi','transaksi/selesai')? 'expand' : '' }}">
            <li class="{{ request()->is('transaksi/pesanan')? 'active' : '' }}"><a href="{{url('transaksi/pesanan')}}"><span>Pesanan</span></a></li>
            <li class="{{ request()->is('transaksi/transaksi')? 'active' : '' }}"><a href="{{url('transaksi/transaksi')}}"><span>Konfirmasi</span></a></li>
            <li class="{{ request()->is('transaksi/selesai')? 'active' : '' }}"><a href="{{url('transaksi/selesai')}}"><span>Transaksi Selesai</span></a></li>

        </ul>
    </li>
    {{-- <li class="{{ request()->is('transaksi')? 'active' : '' }}">
        <a href="{{url('/transaksi')}}" class="link">
            <i class="ti-reload"></i>
            <span>Transaksi</span>
        </a>
    </li> --}}
</ul>
