@extends('layouts.frontend')

@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Detail Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Home</a>
                            <span>Detail Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-details spad">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <i class="fa fa-check-circle"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('storage/gambar/' . $produks->produkgaleri->url) }}" alt="" />
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach ($produk as $produk)
                                <a href="{{ route('shop.detail', ['id' => $produk->id]) }}">
                                    <img data-imgbigurl="{{ asset('storage/gambar/' . $produk->produkgaleri->url) }}"
                                        src="{{ asset('storage/gambar/' . $produk->produkgaleri->url) }}" alt="" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $produks->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(Stok tersedia {{ $produks->totalStock }})</span>
                        </div>
                        <div class="product__details__price">{{ number_format($produks->price) }}</div>
                        <p>
                            {{ $produks->description }}
                        </p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="1" min="1"
                                            max="{{ $produks->stocks->sum('quantity') }}" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $produks->id }}" />
                            <a href="#" class="primary-btn"
                                onclick="event.preventDefault(); this.closest('form').submit();">ADD TO CART</a>
                        </form>
                        <ul>
                            <li><b>Berat</b> <span>
                                    @if ($produks->is_available >= 1000)
                                        {{ floor($produks->is_available / 1000) }} kg
                                    @else
                                        {{ $produks->is_available }} gram
                                    @endif
                                </span></li>
                            <li>
                            <li><b>Stok tersedia</b> <span>
                                    {{ $produks->totalStock }}
                                </span></li>
                            <li>
                                <b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Deskripsi</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Informasi Produk</h6>
                                    <p>
                                        {{ $produks->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .product__details__quantity {
        display: inline-block;
        margin-bottom: 10px;
    }

    .quantity input {
        width: 60px;
        padding: 5px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .quantity input:focus {
        outline: none;
        border-color: #5b9dd9;
        box-shadow: 0 0 5px #5b9dd9;
    }
</style>
