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
    {{-- <div class="container" id="checkout">
    </div> --}}
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
                                <input type="hidden" name="payment" value="{{$transaction->id}}" id="json_callback">
                            </form>
                            <button style="display: inline; border-radius: 5px;" class="btn btn-warning btn-sm center px-3" id="pay-button"><i class="fa fa-shopping-cart"></i> Bayar Sekarang</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- {!! $snap !!} --}}
    <!-- Checkout Section End -->
    @endsection

    @section("client")

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script type="text/javascript">
        let payButton = document.getElementById("pay-button");
        payButton.addEventListener("click", function() {
            window.snap.pay('{{ $snap_token }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                    //window.location.href = '/invoice/{{ $transaction->id }}';
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('Anda Menutup Halaman tanpa menyelesaikan Transaksi');
                }
            })
        });
        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script>
    {{-- <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay({{ '$snapToken' }}, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('Anda Menutup Halaman tanpa menyelesaikan Transaksi');
                }
            })
        });

        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script> --}}
    @endsection

