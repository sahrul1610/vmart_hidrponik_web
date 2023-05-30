@extends('layouts.checkout')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Order</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>my order</span>
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
                <h4>Billing Details</h4>

                <div class="row">
                    @foreach ($transactions as $transaction)
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">
                                    Products <span>Total</span>
                                </div>
                                <ul>
                                    @foreach ($transaction->transactionItems as $transactionItem)
                                        <li>Produk<span>{{ $transactionItem->product->name }}</span></li>
                                    @endforeach
                                    <li>Nama<span>{{ $transaction->user->name }}</span></li>
                                    <li>Alamat<span>{{ $transaction->address }}</span></li>
                                    <li>Harga<span>{{ $transaction->total_price }}</span></li>
                                    <li>Biaya pengiriman<span>{{ $transaction->shipping_price }}</span></li>
                                    <li>Pembayaran<span>
                                            @if ($transaction->payment == 'settlement')
                                                Sukses
                                            @else
                                                {{ $transaction->payment }}
                                            @endif
                                        </span></li>
                                    <li>Status<span>{{ $transaction->status }}</span></li>
                                    {{-- <li>Fresh Vegetable <span>$151.99</span></li>
                                <li>Organic Bananas <span>$53.99</span></li> --}}
                                </ul>
                                <div class="checkout__order__subtotal">
                                    Subtotal
                                    <span>{{ number_format($transaction->total_price + $transaction->shipping_price) }}</span>
                                </div>
                                <div class="checkout__order__total">
                                    Total
                                    <span>{{ number_format($transaction->total_price + $transaction->shipping_price) }}</span>
                                </div>
                                {{-- <a href="{{ route('invoice.export', $transaction->id) }}" target="_blank" class="btn btn-primary">Export to PDF</a>

                                <a style="display: inline; border-radius: 5px;" class="btn btn-warning btn-sm center px-3" href="{{ url('/checkout', $transaction->id) }}"><i class="fa fa-shopping-cart"></i> Bayar Sekarang</a> --}}
                                @if ($transaction->status == 'Dikirim')
                                    <form action="{{ route('order.complete', $transaction->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="site-btn">Pesanan Diterima</button>
                                    </form>
                                @elseif ($transaction->status == 'Selesai')
                                    {{-- <button type="submit" class="site-btn">Berikan Tanggapan</button> --}}
                                    <button type="button" class="site-btn" data-toggle="modal"
                                        data-target="#commentModal{{ $transaction->id }}">Berikan Tanggapan</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- Modal -->
    @foreach ($transactions as $transaction)
        @if ($transaction->status == 'Selesai')
            <div class="modal fade" id="commentModal{{ $transaction->id }}" tabindex="-1" role="dialog"
                aria-labelledby="commentModalLabel{{ $transaction->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel{{ $transaction->id }}">Berikan Tanggapan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('order.comment', $transaction->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">Komentar</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Masukkan komentar Anda"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <!-- Modal End -->
@endsection
