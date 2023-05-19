@extends('layouts.checkout')
@section('css-checkout')
    <style>
        .my-swal-content {
            white-space: pre-line;
        }
    </style>
@endsection
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
                                        <p>Nama<span>*</span></p>
                                        <input type="text" placeholder="{{ auth()->user()->name }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Alamat<span>*</span></p>
                                <input type="text" name="address"
                                    placeholder="Nama Kecamatan, Nama desa, Gedung, No. rumah"
                                    value="{{ old('address') }}" />
                                <div class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>provinsi<span>*</span></p>
                                        <select name="province_origin"
                                            class="js-example-basic-single form-select form-select-sm">
                                            <option value="">Pilih Provinsi asal</option>
                                            @foreach ($province as $province => $value)
                                                <option value="{{ $value['province_id'] }}">{{ $value['province'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger">
                                            @error('province_origin')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Kota<span>*</span></p>
                                        <select name="city_origin"
                                            class="js-example-basic-single form-select form-select-lg">
                                            <option value="">Pilih Kota</option>
                                        </select>
                                        <div class="text-danger">
                                            @error('city_origin')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input" id="courir">
                                <p>Pengiriman<span>*</span></p>
                                <select name="courier" class="js-example-basic-single form-select form-select-lg">
                                    <option value="">Pilih Jasa Pengiriman</option>
                                    @foreach ($courier as $kurir)
                                        <option value="{{ $kurir->code }}">{{ $kurir->title }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('courier')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout__input" id="jasa" style="display: none">
                                <p>Opsi pengiriman<span>*</span></p>
                                <select name="shipping_cost" class="js-example-basic-single form-select form-select-lg">
                                    <option value="">Pilih Opsi Pengiriman</option>
                                    <span id="shipping_cost_price"></span>
                                </select>
                                <div class="text-danger">
                                    @error('shipping_cost')
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
                                <button type="submit" class="site-btn">BUAT PESANAN</button>
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

            // $('select[name="province_origin"]').on('change', function() {
            //     let provinceId = $(this).val();
            //     if (provinceId) {
            //         jQuery.ajax({
            //             url: 'province/' + provinceId + '/cities',
            //             type: "GET",
            //             dataType: "json",
            //             success: function(data) {
            //                 console.log(data);
            //                 $('select[name="city_origin"]').empty();
            //                 $.each(data, function(key, value) {
            //                     $('select[name="city_origin"]').append(
            //                         '<option value="' + value['city_id'] + '">' +
            //                         value['city_name'] + '</option>');
            //                 });
            //             },
            //             error: function(data) {
            //                 alert('Something went wrong');
            //             }

            //         });
            //     } else {
            //         $('select[name="city_origin"]').empty();
            //     }
            // });
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

                            // Tambahkan opsi pertama sebagai placeholder
                            $('select[name="city_origin"]').append(
                                '<option value="">Pilih Kota</option>');

                            $.each(data, function(key, value) {
                                let cityName = value['city_name'];
                                let cityType = value['type'];
                                let optionText = cityType + ' - ' + cityName;
                                $('select[name="city_origin"]').append(
                                    $('<option>').val(value['city_id']).text(
                                        optionText)
                                );
                            });

                            // Jika ingin memunculkan opsi kota secara otomatis, hapus komentar pada baris berikut
                            //$('select[name="city_origin"]').trigger('click');
                        },
                        error: function(data) {
                            alert('Something went wrong');
                        }

                    });
                } else {
                    $('select[name="city_origin"]').empty();
                }
            });

            // Event handler untuk menampilkan opsi kota saat select diklik
            $('select[name="city_origin"]').on('click', function() {
                let cityOptions = $(this).find('option');
                if (cityOptions.length <= 1) {
                    // Jalankan permintaan AJAX untuk mendapatkan kota jika belum ada opsi yang tersedia
                    let provinceId = $('select[name="province_origin"]').val();
                    if (provinceId) {
                        jQuery.ajax({
                            url: 'province/' + provinceId + '/cities',
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                $('select[name="city_origin"]').empty();
                                $.each(data, function(key, value) {
                                    let cityName = value['city_name'];
                                    let cityType = value['type'];
                                    let optionText = cityType + ' - ' + cityName;
                                    $('select[name="city_origin"]').append(
                                        $('<option>').val(value['city_id']).text(
                                            optionText)
                                    );
                                });
                            },
                            error: function(data) {
                                alert('Something went wrong');
                            }

                        });
                    }
                }
            });


            $('select[name="courier"]').on('change', function() {
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
                            $("#jasa").show();
                            // Hapus opsi pengiriman yang ada sebelumnya
                            // $('select[name="shipping_cost"]').empty();

                            // Menambahkan opsi pertama sebagai placeholder
                            $('select[name="shipping_cost"]').append(
                                '<option value="">Pilih Opsi Pengiriman</option>'
                            );
                            $.each(result, function(key, value) {

                                var optionValue = value["cost"][0]["value"];
                                var optionService = value["service"];
                                var optionDescription = value["description"];
                                var optionEtd = value["cost"][0]["etd"];
                                var optionText = optionService + '-' + optionValue +
                                    '-' + optionEtd;
                                var optionElement = $('<option>').val(optionValue).text(
                                    optionText).data('description',
                                    optionDescription).data('etd', optionEtd);
                                $('select[name="shipping_cost"]').prepend(
                                    optionElement);
                            });
                            // let price = result[0]["costs"][0]["cost"][0]["value"];
                            // $("#shipping_cost_price").text(" (Rp " + price + ")");
                            // let price = result[0]["cost"][0]["value"];
                            // $("#shipping_cost_price").text(" (Rp " + price + ")");
                        }
                    })
                } else {
                    $('select[name="shipping_cost"]').empty();
                }
            });
            $('select[name="shipping_cost"]').on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption !== '') {
                    var optionService = $(this).find('option:selected').text().split('-')[0];
                    var optionValue = $(this).find('option:selected').val();
                    var optionEtd = $(this).find('option:selected').data('etd');
                    var optionDescription = $(this).find('option:selected').data('description');

                    // Mengambil nilai terkecil dan terbesar dari etd
                    var etdValues = optionEtd.split('-');
                    var minEtd = etdValues[0];
                    var maxEtd = etdValues[1];
                    var optionText = '<p><strong>Opsi Pengiriman:</strong></p>' +
                        '<div style="margin-top: 10px;">Opsi Service: ' + optionService + '</div>' +
                        '<div style="margin-top: 5px;">Description: ' + optionDescription + '</div>' +
                        '<div style="margin-top: 5px;">Estimasi Waktu (Hari): ' + minEtd + '-' + maxEtd +
                        '</div>';
                    Swal.fire({
                        title: 'Pilihan Pengiriman',
                        html: optionText,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            content: 'my-swal-content'
                        }
                    });
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
