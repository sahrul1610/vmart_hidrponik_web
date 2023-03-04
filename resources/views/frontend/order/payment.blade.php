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
                {{-- <div class="col-lg-8 col-md-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Fist Name<span>*</span></p>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Last Name<span>*</span></p>
                                <input type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="checkout__input">
                        <p>Country<span>*</span></p>
                        <input type="text" />
                    </div>
                    <div class="checkout__input">
                        <p>Address<span>*</span></p>
                        <input
                        type="text"
                        placeholder="Street Address"
                        class="checkout__input__add"
                        />
                        <input
                        type="text"
                        placeholder="Apartment, suite, unite ect (optinal)"
                        />
                    </div>
                    <div class="checkout__input">
                        <p>Town/City<span>*</span></p>
                        <input type="text" />
                    </div>
                    <div class="checkout__input">
                        <p>Country/State<span>*</span></p>
                        <input type="text" />
                    </div>
                    <div class="checkout__input">
                        <p>Postcode / ZIP<span>*</span></p>
                        <input type="text" />
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Phone<span>*</span></p>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="checkout__input">
                        <p>Order notes<span>*</span></p>
                        <input
                        type="text"
                        placeholder="Notes about your order, e.g. special notes for delivery."
                        />
                    </div>
                </div> --}}
                <div class="col-lg-8 col-md-6">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">
                            Products <span>Total</span>
                        </div>
                        <ul>
                            <li>{{ $transaction->total_price}}<span>$75.99</span></li>
                            <li>{{ $transaction->total_price}}<span>$75.99</span></li>
                            <li>{{ $transaction->total_price}}<span>$75.99</span></li>
                            {{-- <li>Fresh Vegetable <span>$151.99</span></li>
                                <li>Organic Bananas <span>$53.99</span></li> --}}
                            </ul>
                            <div class="checkout__order__subtotal">
                                Subtotal <span>$750.99</span>
                            </div>
                            <div class="checkout__order__total">
                                Total <span>$750.99</span>
                            </div>
                            <!-- <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Check Payment
                                    <input type="checkbox" id="payment" />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="checkbox" id="paypal" />
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            {{-- <button type="submit" class="site-btn" id="pay_button">PLACE ORDER</button> --}}
                            <form id="submit_form" method="POST">
                                @csrf
                                <input type="hidden" name="payment" value="{{$transaction->id}}" id="json_callback">
                            </form>
                            <button style="display: inline; border-radius: 5px;" class="btn btn-warning btn-sm center px-3" id="pay-button"><i class="fa fa-shopping-cart"></i> Checkout!</button>
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

