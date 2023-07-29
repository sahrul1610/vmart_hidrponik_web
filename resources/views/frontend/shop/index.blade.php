@extends('layouts.frontend')

@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vmart Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Home</a>
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
                @forelse($produks as $produk)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg"
                                data-setbg="{{ asset('storage/gambar/' . $produk->produkgaleri->url) }}">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <a href="{{ route('like.add', ['id' => $produk->id]) }}"><i
                                            class="fa fa-heart"></i></a>
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
                @empty
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__text text-center">
                                <h5>Data produk tidak ditemukan.</h5>
                                <img src="{{ asset('frontend/img/empty.png') }}" alt="Empty Blog Image">
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ url('/template') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>


    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 2000, // Waktu dalam milidetik (5 detik)
                showConfirmButton: false, // Menghilangkan tombol OK
            });
        </script>
    @elseif (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 2000, // Waktu dalam milidetik (5 detik)
                showConfirmButton: false, // Menghilangkan tombol OK
                didOpen: () => {
                    // Ketika alert ditampilkan, atur opacity menjadi 0.3 untuk memberikan efek fade in
                    Swal.getPopup().style.opacity = 0.3;
                    // Selanjutnya, animasikan opacity kembali menjadi 1 dalam 1 detik untuk memudarkan alert secara perlahan
                    Swal.getPopup().style.transition = 'opacity 1s';
                    Swal.getPopup().style.opacity = 1;
                },
                willClose: () => {
                    // Ketika alert ditutup, atur opacity menjadi 0 dalam 1 detik untuk memudarkan alert secara perlahan sebelum ditutup sepenuhnya
                    Swal.getPopup().style.transition = 'opacity 1s';
                    Swal.getPopup().style.opacity = 0;
                },
            });
        </script>
    @endif
@endpush
