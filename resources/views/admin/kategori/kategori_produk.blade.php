@extends('admin.layouts.template')
@section('title', 'Kategori')
@section('page_scripts')

    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

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
                'success'
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

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>@yield('title')</h4>
                    </div>
                    <div class="card-body">
                        {{-- <p class="form-text mb-2">Basic datatables, support filter, sorting, and search data. add
                            <code>.nowrap</code> for no wrapping text
                        </p> --}}
                        <div class="table-responsive">
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dt->name }}</td>
                                            <td>
                                                {{-- <a href="/buku/detail/{{ $data->id_kategori }}" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a> --}}
                                                <a href="{{ url('/kategori/edit') }}/{{ $dt->id }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>

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
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah @yield('title')</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/kategori/insert') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Kategori</label>

                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name') }}" placeholder="Masukan Kategori">
                                        <div class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
                    "<form method=\"POST\" action=\"{{ url('/kategori/hapus/') }}/" +
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
