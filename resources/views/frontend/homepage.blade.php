@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="mb-5">
        <div class="container">
            <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}">
                <div class="hero__text">
                    <span>FRUIT FRESH</span>
                    <h2>Vegetable <br />100% Organic</h2>
                    <p>Free Pickup and Delivery Available</p>
                    <a href="#" class="primary-btn">SHOP NOW</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Categories Section Begin -->
    <section class="categories mt-5">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($produks as $produk)


                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('storage/gambar/' . $produk->produkgaleri->url) }}">
                            <h5><a href="#">{{$produk->name}}</a></h5>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                {{-- s --}}
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
                                        {{-- <a href="{{ route('cart.add') }}"><i class="fa fa-shopping-cart"></i></a> --}}
                                        {{-- <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $produk->id }}">
                                            <button type="submit"><i class="fa fa-shopping-cart"></i></button>
                                        </form> --}}
                                        {{-- <a href="{{ route('cart.add'/{{ $produk->id }}) }}"><i class="fa fa-shopping-cart"></i></a> --}}
                                        <a href="{{ route('cart.add', ['id' => $produk->id]) }}"><i class="fa fa-shopping-cart"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $produk->name }}</a></h6>
                                <h5>{{ $produk->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend/img/banner/banner-2.jpg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
@endsection
