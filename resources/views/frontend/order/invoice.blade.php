@extends('layouts.checkout')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Invoice</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Invoice</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Invoice</h4>

                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__order">
                            <h4>Detail pesanan</h4>
                            <div class="checkout__order__products">
                                Invoice
                            </div>
                            <ul>
                                <li>nama<span>{{ $transaction->user->name }}</span></li>
                                <li>Alamat<span>{{ $transaction->address }}</span></li>
                                <li>total<span>{{ $transaction->total_price }}</span></li>
                                <li>pembayaran<span>
                                        @if ($transaction->payment == 'settlement')
                                            Sukses
                                        @else
                                            {{ $transaction->payment }}
                                        @endif
                                    </span></li>
                                <li>status<span>{{ $transaction->status }}</span></li>
                            </ul>

                            <div class="checkout__order__subtotal">
                                <a href="{{ route('invoice.export', $transaction->id) }}" target="_blank"
                                    class="btn btn-primary">Export to PDF</a>
                            </div>
                            <div class="checkout__order__subtotal">
                                <a href="{{ route('home') }}" class="btn btn-success">Kembali belanja</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
