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
            <form method="post" action="{{ route('checkout') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Name<span>*</span></p>
                                    <input type="text" placeholder="{{ auth()->user()->name }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address" placeholder="Street Address" />
                            <div class="text-danger">
                                @error('address')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>shipping<span>*</span></p>
                            <input type="text" name="shipping_price" value="10000">
                            <div class="text-danger">
                                @error('shipping_price')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">
                                Products <span>Total</span>
                            </div>
                            <ul>
                                @foreach ($cart as $item)
                                <li>{{ $item['name'] }}<span>{{ $item['price'] }}</span></li>
                                @endforeach
                            </ul>
                            @if (!empty($cart))
                            @php
                            $totalPrice = 0;
                            foreach ($cart as $item) {
                                $totalPrice += $item['price'] * $item['quantity'];
                            }
                            @endphp
                            <input type="hidden" hiden name="total_price" value="{{ $totalPrice }}">

                            <div class="checkout__order__subtotal">
                                Subtotal <span>{{ number_format($totalPrice, 2) }}</span>
                            </div>
                            <div class="checkout__order__total">
                                Total <span>{{ number_format($totalPrice, 2) }}</span>
                            </div>
                            @endif
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection

@push('js')
{{-- <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay({{'$snapToken'}});
        // customer will be redirected after completing payment pop-up
    });
</script> --}}

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay({{ '$snap_token' }}, {
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


@endpush
