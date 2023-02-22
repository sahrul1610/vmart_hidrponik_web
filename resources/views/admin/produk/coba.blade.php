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
                                    aria-selected="true">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Contact</button>
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
                                                        <td>{{ $dt->description }}</td>
                                                        <td>{{ $dt->tags }}</td>
                                                        <td>
                                                            @if ($dt->produkgaleri->count() > 0)
                                                            <img src="{{ asset('storage/gambar/'.$dt->produkgaleri->url) }}"  width="45px" height="45px">
                                                        @else
                                                            Tidak ada gambar
                                                        @endif
                                                        <td>
                                                        <td>
                                                            <a href="{{ url('/produk/edit') }}/{{ $dt->id }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm"
                                                                onclick="DeleteData({{ $dt->id }})"><i
                                                                    class="fa fa-trash"></i></a>
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
                                                    <th>Deskripsi</th>
                                                    <th>Tag</th>
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
                                                        <td>{{ $dt->description }}</td>
                                                        <td>{{ $dt->tags }}</td>
                                                        <td>
                                                            <a href="{{ url('/produk/edit') }}/{{ $dt->id }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm"
                                                                onclick="DeleteData({{ $dt->id }})"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
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
