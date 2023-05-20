@extends('layouts.frontend')
@section('css')
    <style>
        .embed-responsive {
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            overflow: hidden;
        }

        .embed-responsive::before {
            content: "";
            display: block;
            padding-top: 56.25%;
            /* Aspect ratio 16:9 */
        }

        .embed-responsive-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{ asset('frontend/img/blog/details/details-hero.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{!! $blogs->title !!}</h2>
                        <ul>
                            <li>By Vmart</li>
                            <li>{{ \Carbon\Carbon::parse($blogs->created_at)->locale('id')->isoFormat('LL') }}</li>
                            {{-- <li>8 Comments</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->


    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    @include('frontend.blog.sidebar')
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="{{ asset('storage/images/' . $blogs->photo) }}" alt="" width="800"
                            height="500">
                        <p>{!! $blogs->summary !!}</p>
                        <h3>{!! $blogs->title !!}</h3>
                        <p>{!! $blogs->description !!}</p>
                        {{-- <iframe src="https://www.youtube.com/embed/{{ $blogs->url }}" width='640' height='480'
                            frameborder="0" scrolling="">
                        </iframe> --}}
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$blogs->url}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ asset('frontend/img/blog/details/details-author.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Vmart</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Categories:</span> Food</li>
                                        <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
