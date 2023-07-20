@extends('admin.layouts.template')
@section('title', 'Pesanan')

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
                        <h4>@yield('title')</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="Produk-tab" data-bs-toggle="tab"
                                    data-bs-target="#Produk" type="button" role="tab" aria-controls="Produk"
                                    aria-selected="true">Sudah Dibayar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="true">Belum dibayar</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Produk" role="tabpanel"
                                aria-labelledby="Produk-tab">

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="example2" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
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
                                                    @if ($transaction->status == 'paid' && $transaction->payment == 'settlement')
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
                                                            <td>{{ $transaction->payment == 'settlement' ? 'Dibayar' : '' }}</td>
                                                            <td>{{ $transaction->status == 'paid' ? 'Sukses' : '' }}</td>
                                                            <td><button onclick="changeStatus({{ $transaction->id }})"
                                                                    class="btn btn-success">
                                                                    <i class="fa fa-arrow-up"></i>
                                                                </button>
                                                            </td>

                                                            {{-- <td>
                                                                <a href="#"
                                                                    class="btn btn-sm btn-warning"  onclick="changeStatus({{ $transaction->id }})"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm"
                                                                    onclick="DeleteData({{ $transaction->id }})"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </td> --}}
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
                                                    <th>Nama</th>
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
                                                    @if ($transaction->status == 'pending' || $transaction->payment == 'pending' || $transaction->payment == 'failure')
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
                                                            @if ($transaction->created_at_formatted)
                                                            <td>{{ $transaction->created_at_formatted }}
                                                            </td>
                                                            @else
                                                            <td>{{ $transaction->created_at_formatted ?: 'null' }}</td>
                                                            @endif
                                                            <td>{{ $transaction->payment == 'not paid' ? 'Gagal' : '' }}</td>
                                                            <td>{{ $transaction->status == 'pending' ? 'Pending' : '' }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-danger btn-sm"
                                                                    onclick="DeleteData({{ $transaction->id }})"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </td>
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
    function changeStatus(transactionId) {
        var status = 'Barang Dikemas';
        Swal.fire({
            title: "Apakah Anda ingin mengubah status menjadi '" + status + "'?",
            text: "Klik Batal untuk membatalkan perubahan",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ubah"
        }).then(result => {
            if (result.isConfirmed) {
                // Mengirim permintaan ke server untuk mengubah status
                axios.post('/update-status', {
                    transactionId: transactionId,
                    status: status
                }).then(response => {
                    Swal.fire('Status diubah!', 'Status berhasil diubah menjadi "Dikemas"', 'success')
                    .then(() => {
                            location.reload();
                        });
                }).catch(error => {
                    Swal.fire('Error', 'Terjadi kesalahan saat mengubah status', 'error');
                });
            } else {
                Swal.fire('Perubahan Dibatalkan', '', 'error');
            }
        });

    }

    function DeleteData(id) {
        // console.log('tes delete');
        Swal.fire({
            title: "Anda Yakin Ingin Menghapus Data Ini ?",
            text: "Klik Batal Untuk Membatalkan Penghapusan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus"
        }).then(result => {
            if (result.isConfirmed) {
                form_string =
                    "<form method=\"POST\" action=\"{{ url('/transaksi/hapus/') }}/" +
                    id +
                    "\" accept-charset=\"UTF-8\"><input name=\"_method\" type=\"hidden\" value=\"DELETE\"><input name=\"_token\" type=\"hidden\" value=\"{{ csrf_token() }}\"></form>"
                form = $(form_string)
                form.appendTo('body');
                form.submit();
            } else {
                Swal.fire('Selamat!', 'Data anda tidak jadi dihapus', 'error');
            }
        });
    }
</script>
