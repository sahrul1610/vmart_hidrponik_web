@extends('layouts.checkout')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Invoice</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Home</a>
                            <span>Invoice</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                {{-- <li>status<span>{{ $transaction->status }}</span></li> --}}
                                @if ($transaction->status == 'paid')
                                    <li>Status<span>Menunggu dikonfirmasi</span></li>
                                @elseif ($transaction->status == 'Barang Dikemas')
                                    <li>Status<span>Barang dikemas menunggu pengeriman</span></li>
                                @elseif ($transaction->status == 'Dikirim')
                                    <li>Status<span>Dalam pengiriman</span></li>
                                    <li>No Resi<span>{{ $transaction->delivery_receipt }}</span></li>
                                @elseif ($transaction->status == 'Selesai')
                                    <li>Status<span>Barang sudah diterima</span></li>
                                @endif
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
