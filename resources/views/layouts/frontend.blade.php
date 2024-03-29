<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Vmart Project" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="keywords" content="vmart" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Vmart</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    @yield('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css" />
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('frontend/img/logo.png') }}" alt="" /></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <a href="{{ url('/like') }}"><i class="fa fa-heart"></i>
                        @if (session()->has('like'))
                            <span>{{ count(session()->get('like')) }}</span>
                        @else
                            <span>0</span>
                        @endif
                    </a>
                </li>
                <li>
                    {{-- <a href="#"><i class="fa fa-shopping-bag"></i> <span>
                            {{ $cartCount }}
                            cobs
                        </span></a> --}}
                    <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>
                        @if (session()->has('cart'))
                            <span>{{ count(session()->get('cart')) }}</span>
                        @else
                            <span>0</span>
                        @endif
                    </a>
                </li>
            </ul>
            <div class="header__cart__price">item:
                @if (session()->has('cart'))
                    <span>{{ count(session()->get('cart')) }}</span>
                @else
                    <span>0</span>
                @endif
            </div>
        </div>
        <div class="humberger__menu__widget">
            @guest
                <div class="header__top__right__language">
                    <div class="header__top__right__auth">
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                    </div>
                </div>
                <div class="header__top__right__auth" style="margin-left: 20px">
                    <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                </div>
            @else
                <div class="header__top__right__language">
                    <div class="header__top__right__auth">
                        <a href="#"><i class="fa fa-user"></i> {{ auth()->user()->username }}</a>
                    </div>
                    <span class="arrow_carrot-down"></span>
                    <ul style="width:120px;">
                        <li><a href="{{ url('/profile') }}">Profile</a></li>

                        <li><a href="{{ route('myorders') }}">Pesanan Saya</a></li>
                    </ul>
                </div>
                <div class="header__top__right__auth" style="margin-left: 20px">
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                            class="fa fa-user"></i> Logout</a>
                    <form action="{{ route('logout') }}" id="logout-form" method="post">
                        @csrf

                    </form>
                </div>
            @endguest
        </div>
        @include('layouts.mobile_menu')

        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> VmartCorporation@gmail.com</li>
                {{-- <li>Free Shipping for all Order of $99</li> --}}
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> VmartCorporation@gmail.com</li>
                                {{-- <li>Free Shipping for all Order of $99</li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @guest
                            <div class="header__top__right">
                                <div class="header__top__right__language header__top__right__auth">
                                    <a class="d-inline" href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                                </div>
                            </div>
                        @else
                            <div class="header__top__right">
                                <div class="header__top__right__language header__top__right__auth">
                                    <a class="d-inline" href="#"><i class="fa fa-user"></i>
                                        {{ auth()->user()->name }}
                                    </a>
                                    <span class="arrow_carrot-down"></span>
                                    <ul style="width:120px">
                                        <li><a href="{{ url('/profile') }}">Profile</a></li>

                                        <li><a href="{{ route('myorders') }}">Pesanan Saya</a></li>
                                    </ul>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="#"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit()"><i
                                            class="fa fa-user"></i> Logout</a>
                                    <form action="{{ route('logout') }}" id="logout-form" method="post">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{ asset('frontend/img/logo.png') }}" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    @include('layouts.header_menu')

                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="{{ url('/like') }}"><i class="fa fa-heart"></i>
                                    @if (session()->has('like'))
                                        <span>{{ count(session()->get('like')) }}</span>
                                    @else
                                        <span>0</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                {{-- <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-bag"></i>
                                    <span>{{ $cartCount }}</span></a> --}}
                                {{-- <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>
                                    @if (session()->has('cart'))
                                        <span>{{ count(session()->get('cart')) }}</span>
                                    @else
                                        <span>0</span>
                                    @endif
                                </a> --}}

                                <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>
                                    @if (isset($cart) && count($cart) > 0)
                                        <span>{{ count($cart) }}</span>
                                    @else
                                        <span>0</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price">item:
                            @if (session()->has('cart'))
                                <span>{{ count(session()->get('cart')) }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <div class="hero__search__form">
                                <form action="{{ route('produk.search') }}" method="GET">
                                    <input type="text" placeholder="Apa yang anda butuhkan?" name="keyword" />
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+62 899-3484-557</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about" id="about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{ asset('frontend/img/logo.png') }}"
                                    alt="" /></a>
                        </div>
                        <ul>
                            <li>Address: Blk. karang malang, Jatisawit, Kec.Jatibarang, Kab.Indramayu, Jawa Barat 45273</li>
                            <li>Phone: +62 899-3484-557</li>
                            <li>Email: VmartCorporation@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    {{-- <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div> --}}
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>
                            Get E-mail updates about our latest shop and special offers.
                        </p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail" />
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                Vmart Hidroponik
                                <i class="fa fa-heart" aria-hidden="true"></i> by
                                <a href="#" target="_blank">Vmart</a>
                            </p>
                        </div>
                        <div class="footer__copyright__payment">
                            <img src="img/payment-item.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
    <script>
        // ambil data dari local storage
        var cart = JSON.parse(localStorage.getItem('cart')) || {};

        // tampilkan jumlah item dalam keranjang
        var cartCount = Object.keys(cart).length;
        document.getElementById('cart').innerHTML =
            '<a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i><span>' + cartCount + '</span></a>';
    </script>

    @yield('javascript')
</body>

</html>
