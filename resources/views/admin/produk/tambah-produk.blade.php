@extends('admin.layouts.template')
@section('title', 'Tambah Produk')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Default Form</h4>
            </div>
            <form role="form" action="/produk/insert" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Nama</label>
                                <input type="text" placeholder="Masukan nama produk" name="name" class="form-control"
                                    id="basicInput" value="{{ old('name') }}">
                            </div>
                            <div class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Harga</label>
                                <input type="text" placeholder="Masukan harga" name="price" class="form-control"
                                    id="basicInput" value="{{ old('price') }}">
                            </div>
                            <div class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">kategori</label>
                                <select class="js-example-basic-single form-select form-select-sm" name="categories_id"
                                    multiple>
                                    <option value="">- Pilih -</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">
                                            {{ $k->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-danger">
                                @error('categories_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Tag</label>
                                <input type="text" placeholder="Masukan Tags" class="form-control" name="tags"
                                    id="basicInput" value="{{ old('tags') }}">
                            </div>
                            <div class="text-danger">
                                @error('tags')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"
                                    value="{{ old('description') }}"></textarea>
                            </div>
                            <div class="text-danger">
                                @error('description')
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
@endsection
@section('page_scripts')
    <!-- js for select only -->
    <script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/template') }}/plugins/select2/dist/js/select2.min.js"></script>
    <!-- ======= -->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: '- Pilih -'
            });
        });
    </script>
@endsection
