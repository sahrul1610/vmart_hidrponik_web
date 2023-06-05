@extends('admin.layouts.template')
@section('title', 'Produk')
{{-- @section('page_scripts')


    @if (session('gagal'))
        <script>
            Swal.fire(
                'Gagal!',
                '{{ session('gagal') }}',
                'error'
            )
        </script>
    @elseif(session('sukses'))
        <script>
            Swal.fire(
                'Berhasil!',
                '{{ session('sukses') }}',
                'success',
                session()->forget('sukses');
            )
        </script>
    @elseif(session('konfirmasi'))
        <script>
            Swal.fire(
                'Berhasil!',
                '{{ session('konfirmasi') }}',
                'confirmation'
            )
        </script>
    @endif

@stop --}}
{{-- @section('page_scripts')
    @if (session('gagal'))
        <script>
            Swal.fire(
                'Gagal!',
                '{{ session('gagal') }}',
                'error'
            ).then((result) => {
                // Menghapus session gagal
                @php session()->forget('gagal'); @endphp
            })
        </script>
    @elseif(session('sukses'))
        <script>
            Swal.fire(
                'Berhasil!',
                '{{ session('sukses') }}',
                'success'
            ).then((result) => {
                // Menghapus session sukses
                @php session()->forget('sukses'); @endphp
            })
        </script>
    @elseif(session('konfirmasi'))
        <script>
            Swal.fire(
                'Berhasil!',
                '{{ sesi('konfirmasi') }}',
                'konfirmasi'
            ).then((result) => {
                // Menghapus session konfirmasi
                @php session()->forget('konfirmasi'); @endphp
            })
        </script>
    @endif
@stop --}}
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
                                    aria-selected="true">Produk</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="true">Produk</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Produk" role="tabpanel"
                                aria-labelledby="Produk-tab">
                                <div class="card-body">
                                    <p>
                                        <a href="{{ url('produk/add') }}" class="btn btn-primary">
                                            <i class="ti-plus"></i>
                                            Tambah</a>
                                    </p>
                                    <div class="table-responsive">
                                        <table id="example2" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Satuan</th>
                                                    <th>Kategori</th>
                                                    <th>Deskripsi</th>
                                                    <th>Tag</th>
                                                    <th>Gambar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($data as $dt)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $dt->name }}</td>
                                                        <td>{{ $dt->price }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-primary rounded-circle"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#commentModal{{ $dt->id }}"
                                                                type="button">
                                                                {{ $dt->totalStock }} <i class="ti-eye"></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            @if ($dt->is_available >= 1000)
                                                                {{ floor($dt->is_available / 1000) }} kg
                                                            @else
                                                                {{ $dt->is_available }} g
                                                            @endif
                                                        </td>
                                                        <td>{{ $dt->getKategori->name }}</td>
                                                        <td>{{ $dt->description }}</td>
                                                        <td>{{ $dt->tags }}</td>
                                                        <td>
                                                            @if ($dt->produkgaleri)
                                                                <img src="{{ asset('storage/gambar/' . $dt->produkgaleri->url) }}"
                                                                    width="45px" height="45px">
                                                            @else
                                                                Tidak ada gambar
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('/produk/edit') }}/{{ $dt->id }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm"
                                                                onclick="DeleteData({{ $dt->id }})"><i
                                                                    class="fa fa-trash"></i></a>
                                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                                data-bs-target="#addStockModal{{ $dt->id }}"
                                                                type="button"><i class="fa fa-plus"></i>Tambah
                                                                Stok</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-body">
                                    <p>
                                        <a href="{{ url('produk/add') }}" class="btn btn-primary">
                                            <i class="ti-plus"></i>
                                            Tambah</a>
                                    </p>
                                    <div class="table-responsive">
                                        <table id="example" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Satuan</th>
                                                    <th>Kategori</th>
                                                    <th>Deskripsi</th>
                                                    <th>Tag</th>
                                                    <th>Gambar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($data as $dt)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $dt->name }}</td>
                                                        <td>{{ $dt->price }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-primary rounded-circle"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#commentModal{{ $dt->id }}"
                                                                type="button">
                                                                {{ $dt->totalStock }} <i class="ti-eye"></i>
                                                            </button>
                                                        </td>
                                                        <td>{{ $dt->is_available }} kg</td>
                                                        <td>{{ $dt->getKategori->name }}</td>
                                                        <td>{{ $dt->description }}</td>
                                                        <td>{{ $dt->tags }}</td>
                                                        <td>
                                                            @if ($dt->produkgaleri)
                                                                <img src="{{ asset('storage/gambar/' . $dt->produkgaleri->url) }}"
                                                                    width="45px" height="45px">
                                                            @else
                                                                Tidak ada gambar
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('/produk/edit') }}/{{ $dt->id }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm"
                                                                onclick="DeleteData({{ $dt->id }})"><i
                                                                    class="fa fa-trash"></i></a>
                                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                                data-bs-target="#addStockModal{{ $dt->id }}"
                                                                type="button"><i class="fa fa-plus"></i>Tambah
                                                                Stok</button>
                                                        </td>
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

    @foreach ($data as $dt)
        <div class="modal fade" id="commentModal{{ $dt->id }}" tabindex="-1" aria-labelledby="largeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="laergeModalLabel">Stok Produk - {{ $dt->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow: auto;">
                        <p>Jumlah Stok: {{ $dt->totalStock }}</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dt->stocks as $key => $stock)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $stock->created_at }}</td>
                                        <td>{{ $stock->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($data as $dt)
        <div class="modal fade" id="addStockModal{{ $dt->id }}" tabindex="-1" role="dialog"
            aria-labelledby="addStockModal{{ $dt->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStockModal{{ $dt->id }}Label">Tambah Stok -
                            {{ $dt->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('addStock', ['id' => $dt->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="quantity">Jumlah Stok</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah Stok</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
<script>
    function DeleteData(id) {
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
                    "<form method=\"POST\" action=\"{{ url('/produk/hapus/') }}/" +
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
