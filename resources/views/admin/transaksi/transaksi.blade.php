@extends('admin.layouts.template')
@section('title', 'Transaksi')

@section('page_scripts')
    @if (session('gagal'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('gagal') }}',
                icon: 'error'
            }).then(function() {
                {{ session()->forget('gagal') }}
            });
        </script>
    @elseif(session('sukses'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('sukses') }}',
                icon: 'success'
            }).then(function() {
                location.reload();
                {{ session()->forget('sukses') }}
            });
        </script>
    @elseif(session('konfirmasi'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('konfirmasi') }}',
                icon: 'confirmation'
            }).then(function() {
                {{ session()->forget('konfirmasi') }}
            });
        </script>
    @endif
@stop

{{-- @endsection --}}
@section('content')
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Default tabs</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="Produk-tab" data-bs-toggle="tab"
                                    data-bs-target="#Produk" type="button" role="tab" aria-controls="Produk"
                                    aria-selected="true">Transaksi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="true">Transaksi</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Produk" role="tabpanel"
                                aria-labelledby="Produk-tab">
                                <div class="card-body">
                                    {{-- <p>
                                        <a href="{{ url('produk/add') }}" class="btn btn-primary">
                                            <i class="ti-plus"></i>
                                            Tambah</a>
                                    </p> --}}
                                    <div class="table-responsive">
                                        <table id="example2" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>total</th>
                                                    <th>shipping</th>
                                                    <th>status</th>
                                                    <th>pembayaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach($transactions as $transaction)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $transaction->user->name }}</td>
                                                        <td>{{ number_format($transaction->total_price) }}</td>
                                                        <td>{{ number_format($transaction->shipping_price) }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->payment }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-body">
                                    {{-- <p>
                                        <a href="{{ url('produk/add') }}" class="btn btn-primary">
                                            <i class="ti-plus"></i>
                                            Tambah</a>
                                    </p> --}}
                                    <div class="table-responsive">
                                        <table id="example" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>total</th>
                                                    <th>shipping</th>
                                                    <th>status</th>
                                                    <th>pembayaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach($transactions as $transaction)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $transaction->user->name }}</td>
                                                        <td>{{ number_format($transaction->total_price) }}</td>
                                                        <td>{{ number_format($transaction->shipping_price) }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->payment }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
