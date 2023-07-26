@extends('admin.layouts.template')
@section('title', 'dashboard')
@section('content')
    <div class="row same-height">
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Produk</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $jumlah_produk }}</span>
                    <span class="float-right">
                        <i class="ti-shopping-cart fa-2x"></i>
                    </span>
                </div>
                <div class="card-footer">
                    <a href="{{ route('produk') }}" class="text-white" style="text-decoration: none;">
                        More Information
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Transaksi</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $transaksi }}</span>
                    <span class="float-right">
                        <i class="ti-reload fa-2x"></i>
                    </span>
                    <p class="mt-3 mb-0 text-sm">

                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('transaksi') }}" class="text-white" style="text-decoration: none;">
                        More Information
                        <span class="text-white mr-2"><i class="fa fa-arrow-up"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Customer</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $user }}</span>
                    <span class="float-right">
                        <i class="ti-user fa-2x"></i>
                    </span>
                </div>
                <div class="card-footer">
                    <a href="{{ route('pengguna') }}" class="text-white" style="text-decoration: none;">
                        More Information
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <span class="h2 font-weight-bold mb-0">{{number_format($total_transaksi)}}</span>
                    <span class="float-right">
                        <i class="ti-money fa-2x"></i>
                    </span>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/transaksi/selesai') }}" class="text-white" style="text-decoration: none;">
                        More Information
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    </a>
                </div>
            </div>
        </div>


    </div>
    <div class="row same-height">
        {{-- <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Selamat Datang di Dashboard Admin</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Selamat Datang di Dashboard Admin</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa eos
                        facere impedit dolorem necessitatibus quidem non in, optio similique eveniet hic,
                        consequatur, quo pariatur eum modi excepturi. Iusto, facilis totam.</p>
                </div>
                <div class="card-footer">
                    Card footer
                </div>
            </div>
        </div> --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Monthly Sales</h4>
                </div>
                <div class="card-body">
                    <canvas id="chart-transaksi" height="642" width="1388"></canvas>
                    {{-- {!! $chart->container() !!} --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Monthly Sales</h4>
                </div>
                <div class="card-body">
                    <canvas id="donat-transaksi" style="width: 200px; height: 200px;"></canvas>
                    {{-- {!! $chart->container() !!} --}}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('page_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chart-transaksi').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($dataBulan) !!},
                datasets: [{
                    label: 'Transaksi perbulan',
                    data: {!! json_encode($dataTransaksi) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('donat-transaksi').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($dataBulan) !!},
                datasets: [{
                    label: 'Transaksi perbulan',
                    data: {!! json_encode($dataTransaksi) !!},
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutoutPercentage: 70
            }
        });
    </script>

@endsection
