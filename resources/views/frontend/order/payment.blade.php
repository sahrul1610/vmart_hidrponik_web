@extends('layouts.checkout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
                        <span>Checkout</span>
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

                <div class="col-lg-6 col-md-6">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">
                            Products <span>Total</span>
                        </div>
                        <ul>
                            <li>Nama<span>{{ $transaction->user->name }}</span></li>
                            <li>Alamat<span>{{ $transaction->address }}</span></li>
                            <li>Pengiriman<span>{{ $transaction->shipping_price }}</span></li>
                            <li>Harga barang<span>{{ number_format($transaction->total_price) }}</span></li>
                            <li>Pembayaran<span>{{ $transaction->payment }}</span></li>
                            <li>Status<span>{{ $transaction->status }}</span></li>
                            </ul>
                            <div class="checkout__order__subtotal">
                                Subtotal <span>{{ number_format($transaction->total_price + $transaction->shipping_price) }}</span>
                            </div>
                            <div class="checkout__order__total">
                                Total <span>Rp.{{ number_format($transaction->total_price + $transaction->shipping_price) }},-</span>
                            </div>
                            <form id="submit_form" method="POST">
                                @csrf
                                <input type="hidden" name="payment" value="{{$transaction->id}}" id="json_callback">
                            </form>
                            <button style="display: inline; border-radius: 5px;" class="btn btn-warning btn-sm center px-3" id="pay-button"><i class="fa fa-shopping-cart"></i> Bayar Sekarang</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    @endsection

    @section("client")
    <script type="text/javascript">
        let payButton = document.getElementById("pay-button");
        payButton.addEventListener("click", function() {
            window.snap.pay('{{ $snap_token }}', {
                onSuccess: function(result) {
                    console.log(result);
                    send_response_to_form(result);
                },
                onPending: function(result) {
                    console.log(result);
                    send_response_to_form(result);
                },
                onError: function(result) {
                    console.log(result);
                    send_response_to_form(result);
                },
                onClose: function() {
                    alert('Anda Menutup Halaman tanpa menyelesaikan Transaksi');
                }
            })
        });
        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script>
    @endsection

