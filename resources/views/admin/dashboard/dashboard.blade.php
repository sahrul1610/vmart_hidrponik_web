@extends('admin.layouts.template')
@section('title', 'dashboard')
@section('content')
    <div class="row same-height">
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Produk</h5>
                    <span class="h2 font-weight-bold mb-0">{{$jumlah_produk}}</span>
                    <span class="float-right">
                        <i class="ti-shopping-cart fa-2x"></i>
                    </span>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Transaksi</h5>
                    <span class="h2 font-weight-bold mb-0">{{$transaksi}}</span>
                    <span class="float-right">
                        <i class="ti-user fa-2x"></i>
                    </span>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Customer</h5>
                    <span class="h2 font-weight-bold mb-0">{{$user}}</span>
                    <span class="float-right">
                        <i class="ti-user fa-2x"></i>
                    </span>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <span class="h2 font-weight-bold mb-0">350,897</span>
                    <span class="float-right">
                        <i class="ti-user fa-2x"></i>
                    </span>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
