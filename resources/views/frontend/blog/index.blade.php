@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vmart Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    @include('frontend.blog.sidebar')
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @forelse($blogs as $dt)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="{{ asset('storage/images/' . $dt->photo) }}" alt="">

                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i>
                                                {{ \Carbon\Carbon::parse($dt->created_at)->locale('id')->isoFormat('LL') }}
                                            </li>
                                            {{-- <li><i class="fa fa-comment-o"></i> 5</li> --}}
                                        </ul>
                                        <h5><a href="{{ route('blog.detail', ['id' => $dt->id]) }}">{{ $dt->title }}</a>
                                        </h5>
                                        {!! $dt->summary !!}
                                        <a href="{{ route('blog.detail', ['id' => $dt->id]) }}" class="blog__btn">READ MORE
                                            <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__text text-center">
                                        <h5>Data blog tidak ditemukan.</h5>
                                        <img src="{{ asset('frontend/img/empty.png') }}" alt="Empty Blog Image">
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                {{-- <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}

                                {{-- nanti coba terapkan tanpa menggunakan a href --}}
                                {{ $blog->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
