<ul>
    <li class="{{request()->is('dashboard')? 'active' : ''}}">
        <a href="{{url('/')}}" class="link">
            <i class="ti-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ request()->is('kategori','produk')? 'active open' : '' }}">
        <a href="#" class="main-menu has-dropdown">
            <i class="ti-desktop"></i>
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
    <li class="{{ request()->is('transaksi')? 'active' : '' }}">
        <a href="{{url('/transaksi')}}" class="link">
            <i class="ti-user"></i>
            <span>Transaksi</span>
        </a>
    </li>
</ul>
