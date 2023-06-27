@extends('admin.layouts.template')
@section('title', 'Edit Produk')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Default Form</h4>
            </div>
            <form role="form" action="/produk/update" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ $edit->id }}">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Nama</label>
                                <input type="text" placeholder="Masukan nama produk" name="name" class="form-control"
                                    id="basicInput" value="{{ $edit->name }}">
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
                                <input type="number" placeholder="Masukan harga" name="price" class="form-control"
                                    id="basicInput" value="{{ $edit->price }}">
                            </div>
                            <div class="text-danger">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="basicInput" class="form-label">Satuan</label>
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukan satuan" name="is_available" class="form-control"
                                    id="basicInput" value="{{ $edit->is_available }}">
                                <select class="input-group-text form-select" name="unit">
                                    <option value="g">gram</option>
                                    <option value="kg">kg</option>
                                </select>
                            </div>
                            <div class="text-danger">
                                @error('is_available')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">kategori</label>
                                <select class="js-example-basic-single form-select form-select-sm" name="categories_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($kategori as $k)
                                        @if ($k->id == $edit->categories_id)
                                            <option value="{{ $k->id }}" selected>
                                                {{ $k->name }}
                                            </option>
                                        @else
                                            <option value="{{ $k->id }}">
                                                {{ $k->name }}
                                            </option>
                                        @endif
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
                                    id="basicInput" value="{{ $edit->tags }}">
                            </div>
                            <div class="text-danger">
                                @error('tags')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="url" id='url' placeholder=""
                                    value="{{ $edit->produkgaleri->url }}">
                                @if ($edit->produkgaleri)
                                    <p>gambar saat ini : <img src="{{ asset('storage/gambar/' . $edit->produkgaleri->url) }}" width="50px"></p>

                                @else
                                    tidak ada gambar
                                @endif
                            </div>
                            <div class="text-danger">
                                @error('url')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $edit->description }}</textarea>
                            </div>
                            <div class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
