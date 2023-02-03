@extends('admin.layouts.template')
@section('title','Kategori')
@section("page_scripts")

{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

@if(session("gagal"))

<script>
    Swal.fire(
    'Gagal!',
    '{{ session("gagal") }}',
    'error'
    )
</script>

@elseif(session("sukses"))

<script>
    Swal.fire(
    'Berhasil!',
    '{{ session("sukses") }}',
    'success'
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
                        <h4>Basic</h4>
                    </div>
                    <div class="card-body">
                        <p class="form-text mb-2">Basic datatables, support filter, sorting, and search data. add
                            <code>.nowrap</code> for no wrapping text
                        </p>
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
                                            <td>{{$no++}}</td>
                                            <td>{{$dt->name}}</td>
                                            <td>
                                                {{-- <a href="/buku/detail/{{ $data->id_kategori }}" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a> --}}
                                                <a href="{{url('/kategori/edit')}}/{{ $dt->id }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <form action="{{url('/kategori/hapus')}}" method="POST" style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $dt->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
                        <h4>Basic</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/kategori/insert')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Default Input</label>

                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Masukan Kategori"
                                       >
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
