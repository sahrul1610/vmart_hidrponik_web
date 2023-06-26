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
                        <h4>Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="Produk-tab" data-bs-toggle="tab"
                                    data-bs-target="#Produk" type="button" role="tab" aria-controls="Produk"
                                    aria-selected="true">Barang Dikemas</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="true">Barang
                                    Dikirim</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Produk" role="tabpanel"
                                aria-labelledby="Produk-tab">
                                <div class="card-body">
                                    <p>
                                        <a href="#" onclick="switchToProfileTab()" class="btn btn-primary">Lihat Barang Dikirim <i class="fa fa-arrow-right"></i></a>
                                    </p>
                                    <div class="table-responsive">
                                        <table id="example2" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Produk</th>
                                                    <th>Total</th>
                                                    <th>Shipping</th>
                                                    <th>Grand total</th>
                                                    <th>Tanggal Pesan</th>
                                                    <th>Pembayaran</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($transactions as $transaction)
                                                    @if ($transaction->status == 'Barang Dikemas')
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $transaction->user->name }}</td>
                                                            {{-- @foreach ($transaction->transactionItems as $item)
                                                                <td>{{ $item->product->name }}</td>
                                                            @endforeach --}}
                                                            <td>
                                                                @foreach ($transaction->transactionItems as $item)
                                                                    {{ $item->product->name }}<br>
                                                                @endforeach
                                                            </td>
                                                            <td>{{ number_format($transaction->total_price) }}</td>
                                                            <td>{{ number_format($transaction->shipping_price) }}</td>
                                                            <td>{{ number_format($transaction->total_price + $transaction->shipping_price) }}
                                                            </td>
                                                            @if ($transaction->created_at_formatted)
                                                                <td>{{ $transaction->created_at_formatted }}
                                                                </td>
                                                            @else
                                                                <td>{{ $transaction->created_at_formatted ?: 'null' }}</td>
                                                            @endif
                                                            <td>{{ $transaction->payment }}</td>
                                                            <td>{{ $transaction->status }}</td>
                                                            <td><button
                                                                    onclick="inputDeliveryReceipt({{ $transaction->id }})"
                                                                    class="btn btn-success">Kirim Barang</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Produk</th>
                                                    <th>Total</th>
                                                    <th>Shipping</th>
                                                    <th>Grand total</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Pesan</th>
                                                    <th>Pembayaran</th>
                                                    <th>Resi Pengiriman</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($transactions as $transaction)
                                                    @if ($transaction->status == 'Dikirim')
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $transaction->user->name }}</td>
                                                            <td>
                                                                @foreach ($transaction->transactionItems as $item)
                                                                    {{ $item->product->name }}
                                                                @endforeach
                                                            </td>
                                                            <td>{{ number_format($transaction->total_price) }}</td>
                                                            <td>{{ number_format($transaction->shipping_price) }}</td>
                                                            <td>{{ number_format($transaction->total_price + $transaction->shipping_price) }}
                                                            </td>
                                                            <td>{{ $transaction->status }}</td>
                                                            @if ($transaction->created_at_formatted)
                                                                <td>{{ $transaction->created_at_formatted }}
                                                                </td>
                                                            @else
                                                                <td>{{ $transaction->created_at_formatted ?: 'null' }}</td>
                                                            @endif
                                                            <td>{{ $transaction->payment }}</td>
                                                            <td>{{ $transaction->delivery_receipt ?: 'null' }}</td>
                                                        </tr>
                                                    @endif
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function inputDeliveryReceipt(transactionId) {
        Swal.fire({
            title: "Masukkan Resi Pengiriman",
            input: "text",
            inputPlaceholder: "Masukkan resi pengiriman...",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.isConfirmed) {
                const deliveryReceipt = result.value;
                if (deliveryReceipt) {
                    // Mengirim permintaan ke server untuk menyimpan resi pengiriman
                    axios.post('/input-delivery-receipt', {
                        transactionId: transactionId,
                        deliveryReceipt: deliveryReceipt
                    }).then(response => {
                        Swal.fire('Resi Pengiriman Disimpan!', 'Resi pengiriman berhasil disimpan.',
                                'success')
                            .then(() => {
                                // Lakukan refresh halaman atau tindakan lain jika perlu
                                location.reload();
                            });
                    }).catch(error => {
                        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan resi pengiriman', 'error');
                    });
                } else {
                    Swal.fire('Error', 'Mohon masukkan resi pengiriman', 'error');
                }
            }
        });
    }

    function switchToProfileTab() {
        $('#profile-tab').tab('show');
    }
</script>
