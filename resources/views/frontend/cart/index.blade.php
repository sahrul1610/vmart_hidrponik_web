@extends('layouts.checkout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        {{-- <div class="container" id="cart">
        </div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('frontend/img/cart/cart-1.jpg')}}" alt="">
                                        <h5>Vegetable’s Package</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $55.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $110.00
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr> --}}
                                @forelse ($cart as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            {{-- {{ asset('storage/gambar/' . $produk->produkgaleri->url) }} --}}
                                            <img src="{{ asset('storage/gambar/'.$item['gambar']) }}" width="100px" height="100px">
                                            <h5>{{ $item['name'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $item['price'] }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $item['quantity'] }}" min="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ $item['price'] * $item['quantity'] }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('cart.remove', $item['id']) }}" class="icon_close"></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <h3>Your cart is empty</h3>
                                            <a href="{{route('home')}}" class="btn btn-primary mt-3">Shop now</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (!empty($cart))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                            <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                Upadate Cart</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                <form action="#">
                                    <input type="text" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">APPLY COUPON</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @php
                        $totalPrice = 0;
                        foreach ($cart as $item) {
                            $totalPrice += $item['price'] * $item['quantity'];
                        }
                    @endphp
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>${{ number_format($totalPrice, 2) }}</span></li>
                                <li>Total <span>${{ number_format($totalPrice, 2) }}</span></li>
                                {{-- <li>Subtotal <span>$454.98</span></li>
                                <li>Total <span>$454.98</span></li> --}}
                                {{-- <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                                <li>Tax <span>${{ Cart::tax() }}</span></li>
                                <li>Total <span>${{ Cart::total() }}</span></li> --}}
                            </ul>
                            <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

