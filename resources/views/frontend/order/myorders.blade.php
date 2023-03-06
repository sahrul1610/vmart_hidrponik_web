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
        {{-- <div class="container" id="checkout">
    </div> --}}
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
                                        <li>produk<span>{{ $transactionItem->product->name }}</span></li>
                                    @endforeach
                                    <li>nama<span>{{ $transaction->user->name }}</span></li>
                                    <li>Alamat<span>{{ $transaction->address }}</span></li>
                                    <li>total<span>{{ $transaction->total_price }}</span></li>
                                    <li>pembayaran<span>{{ $transaction->payment }}</span></li>
                                    <li>status<span>{{ $transaction->status }}</span></li>
                                    {{-- <li>Fresh Vegetable <span>$151.99</span></li>
                                <li>Organic Bananas <span>$53.99</span></li> --}}
                                </ul>
                                <div class="checkout__order__subtotal">
                                    Subtotal <span>$750.99</span>
                                </div>
                                <div class="checkout__order__total">
                                    Total <span>$750.99</span>
                                </div>

                                <form id="submit_form" method="POST">
                                    @csrf
                                    <input type="hidden" name="payment" value="{{ $transaction->id }}" id="json_callback">
                                </form>
                                <a style="display: inline; border-radius: 5px;" class="btn btn-warning btn-sm center px-3" href="{{ url('/checkout', $transaction->id) }}"><i class="fa fa-shopping-cart"></i> Bayar Sekarang</a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    {{-- {!! $snap !!} --}}
    <!-- Checkout Section End -->
@endsection

