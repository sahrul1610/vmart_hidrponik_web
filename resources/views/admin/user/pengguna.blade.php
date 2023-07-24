@extends('admin.layouts.template')
@section('title', 'Pengguna')
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
@section('content')

    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>@yield('title')</h4>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td><a href="#" class="btn btn-danger btn-sm"
                                                onclick="DeleteData({{ $dt->id }})"><i class="fa fa-trash"></i></a>
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
                    "<form method=\"POST\" action=\"{{ url('/pengguna/hapus/') }}/" +
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
