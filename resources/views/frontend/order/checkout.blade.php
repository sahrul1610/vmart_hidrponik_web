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
                        @foreach ($cart as $item)

                            <input type="hidden" name="weight" value="{{ $item['tersedia'] }}">
                        @endforeach
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
                                <p>provinsi<span>*</span></p>
                                {{-- <select type="text" name="address"  class="provinsi"></select> --}}
                                <select name="province_origin" class="js-example-basic-single form-select form-select-lg">
                                    <option value="">Pilih Provinsi asal</option>
                                    @foreach ($province as $province => $value)
                                        <option value="{{ $value['province_id'] }}">{{ $value['province'] }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Kota<span>*</span></p>
                                {{-- <select type="text" name="address"  class="provinsi"></select> --}}
                                <select name="city_origin" class="js-example-basic-single form-select form-select-lg">
                                    <option value="">Pilih Kota asal</option>
                                    {{-- @foreach ($city as $city)
                                        <option value="">{{ $city['city_name'] }}</option>
                                    @endforeach --}}
                                </select>

                                <div class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout__input" id="courir">
                                <p>Cost<span>*</span></p>
                                {{-- <select type="text" name="address"  class="provinsi"></select> --}}
                                <select name="courier" class="js-example-basic-single form-select form-select-lg">
                                    <option value="">Pilih a asal</option>
                                    @foreach ($courier as $kurir)
                                        <option value="{{ $kurir->code }}">{{ $kurir->title }}</option>
                                    @endforeach
                                </select>

                                <div class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout__input" id="hamdan" style="display: none">
                                <p>Cost<span>*</span></p>
                                {{-- <select type="text" name="address"  class="provinsi"></select> --}}
                                <select name="shipping_cost" class="js-example-basic-single form-select form-select-lg">
                                    <option value="">Pilih pembayaran</option>
                                    <span id="shipping_cost_price"></span>
                                </select>

                                <div class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            {{-- <div class="checkout__input">
                                <p>shipping<span>*</span></p>
                                <input type="text" name="shipping_price" value="10000">
                                <div class="text-danger">
                                    @error('shipping_price')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div> --}}
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
    <!-- js for select only -->
    {{-- <script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script> --}}
    <script src="{{ url('/template') }}/plugins/select2/dist/js/select2.min.js"></script>
    <!-- ======= -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                //  placeholder: '- Pilih -'
                width: '100%',
                height: '100%',
                allowclear: true
            });
        });
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
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

    <script>
        $(document).ready(function() {

            $('select[name="province_origin"]').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    jQuery.ajax({
                        url: 'province/' + provinceId + '/cities',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('select[name="city_origin"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city_origin"]').append(
                                    '<option value="' + value['city_id'] + '">' +
                                    value['city_name'] + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_origin"]').empty();
                }
            });

            $('select[name="courier"]').on('change', function() {
                //     let cityOriginId = $(this).val();
                //    // let weight = $('input[name="weight"]').val();
                //     let courier = $('select[name="courier"]').val();
                let courier = $(this).val();
                let cityOriginId = $('select[name="city_origin"]').val();
                let weight = $('input[name="weight"]').val();

                if (cityOriginId) {
                    $.ajax({
                        url: "{{ url('/city') }}/" + cityOriginId + "/cities",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            cityOriginId: cityOriginId,
                            courier: courier,
                            weight: weight,

                        },
                        success: function(result) {
                            $("#hamdan").show();
                            $.each(result, function(key, value) {
                                $('select[name="shipping_cost"]').append(
                                    '<option value=' + value["cost"][0]["value"] +
                                    '>' + value["service"] + '-' + value["cost"][0][
                                        "value"
                                    ] + '</option>');
                            });
                            // let price = result[0]["costs"][0]["cost"][0]["value"];
                            // $("#shipping_cost_price").text(" (Rp " + price + ")");
                            let price = result[0]["cost"][0]["value"];
                            $("#shipping_cost_price").text(" (Rp " + price + ")");
                        }
                    })
                    // jQuery.ajax({
                    //     url: "{{ url('/city/') }}" + cityOriginId + "/cost",
                    //     type: "POST",
                    //     data: {
                    //         _token: "{{ csrf_token() }}",
                    //         city_origin: cityOriginId,
                    //     },
                    //     success: function(result) {
                    //         if (result) {
                    //             let costs = result[0]['costs'];
                    //             let html = '';

                    //             $.each(costs, function(index, cost) {
                    //                 html += '<option value="' + cost['cost'][0][
                    //                     'value'] + '">' + cost['service'] + ' - ' +
                    //                     cost['cost'][0]['etd'] + ' Hari (' + cost[
                    //                         'cost'][0]['value'] + ')</option>';
                    //             });

                    //             $('select[name="shipping_cost"]').empty().append(html);
                    //         }
                    //     },
                    // });
                } else {
                    $('select[name="shipping_cost"]').empty();
                }
            });

            $('select[name="city_destination"]').on('change', function() {
                $('select[name="city_origin"]').trigger('change');
            });

            // $('select[name="courier"]').on('change', function() {
            //     $('select[name="city_origin"]').trigger('change');
            // });

            $('select[name="courier"]').on('change', function() {
                $('select[name="shipping_cost"]').empty();
                $('select[name="city_origin"]').trigger('change');
            });


        });
    </script>
@endpush
