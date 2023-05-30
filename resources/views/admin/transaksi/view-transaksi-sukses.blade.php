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
                                    aria-selected="true">Selesai</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Produk" role="tabpanel"
                                aria-labelledby="Produk-tab">

                                <div class="card-body">
                                    <p>
                                        <a href="{{ route('transaksi.cetak-pdf') }}" class="btn btn-success">
                                            <i class="fa fa-file-pdf"></i>
                                            Export PDF</a>
                                        <a href="{{ route('transaksi.export') }}" class="btn btn-primary">
                                            <i class="fa fa-file-excel"></i>
                                            Export EXCEL</a>

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
                                                    @if ($transaction->status == 'Selesai')
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
                                                            <td>
                                                                {{-- <button
                                                                    onclick="inputDeliveryReceipt({{ $transaction->id }})"
                                                                    class="btn btn-warning">{{ $transaction->status }}</button> --}}

                                                                @if ($transaction->status == 'Selesai' && $transaction->comments->count() > 0)
                                                                        <button class="btn mb-2 btn-success" data-bs-toggle="modal" data-bs-target="#commentModal{{ $transaction->id }}"
                                                                        type="button">Tanggapan<i class="fa fa-envelope"></i></button>
                                                                @else
                                                                    -
                                                                @endif
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

    {{-- Modal untuk menampilkan tanggapan --}}
    @foreach ($transactions as $transaction)
        @if ($transaction->status == 'Selesai' && $transaction->comments->count() > 0)
            <div class="modal fade" id="commentModal{{ $transaction->id }}" tabindex="-1"
                aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="laergeModalLabel">Tanggapan dari {{ $transaction->user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow: auto;">
                            @foreach ($transaction->comments as $comment)
                                <p class="comment-text">{{ $comment->comment }}</p>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    .comment-text {
        word-wrap: break-word;
        /* atau */
        /* word-break: break-word; */
    }
</style>
<script>
    // function inputDeliveryReceipt(transactionId) {
    //     Swal.fire({
    //         title: "Masukkan Resi Pengiriman",
    //         input: "text",
    //         inputPlaceholder: "Masukkan resi pengiriman...",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Simpan",
    //         cancelButtonText: "Batal"
    //     }).then(result => {
    //         if (result.isConfirmed) {
    //             const deliveryReceipt = result.value;
    //             if (deliveryReceipt) {
    //                 // Mengirim permintaan ke server untuk menyimpan resi pengiriman
    //                 axios.post('/input-delivery-receipt', {
    //                     transactionId: transactionId,
    //                     deliveryReceipt: deliveryReceipt
    //                 }).then(response => {
    //                     Swal.fire('Resi Pengiriman Disimpan!', 'Resi pengiriman berhasil disimpan.',
    //                             'success')
    //                         .then(() => {
    //                             // Lakukan refresh halaman atau tindakan lain jika perlu
    //                             location.reload();
    //                         });
    //                 }).catch(error => {
    //                     Swal.fire('Error', 'Terjadi kesalahan saat menyimpan resi pengiriman', 'error');
    //                 });
    //             } else {
    //                 Swal.fire('Error', 'Mohon masukkan resi pengiriman', 'error');
    //             }
    //         }
    //     });
    // }
</script>
