@extends('layouts.frontend')

@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vmart Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('home')}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    @include('frontend.shop.sidebar')
                </div>
                @foreach ($produks as $produk)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg"
                                data-setbg="{{ asset('storage/gambar/' . $produk->produkgaleri->url) }}">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cart.add', ['id' => $produk->id]) }}"><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="{{ route('shop.detail', ['id' => $produk->id]) }}">{{ $produk->name }}</a></h6>
                                <h5>{{ number_format($produk->price) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
@endsection
