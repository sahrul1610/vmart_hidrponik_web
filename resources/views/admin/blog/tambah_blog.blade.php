@extends('admin.layouts.template')
@section('title', 'Tambah Produk')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Default Form</h4>
            </div>
            <form role="form" action="/posts/insert" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Judul</label>
                                <input type="text" placeholder="Masukan nama judul" name="title" class="form-control"
                                    id="basicInput" value="{{ old('title') }}">
                            </div>
                            <div class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Slug</label>
                                <input type="text" placeholder="Masukan slug" name="slug" class="form-control"
                                    id="basicInput" value="{{ old('slug') }}">
                            </div>
                            <div class="text-danger">
                                @error('slug')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">kategori</label>
                                <select class="js-example-basic-single form-select form-select-sm" name="category_id"
                                    multiple>
                                    <option value="">- Pilih -</option>
                                    @foreach ($categories as $k)
                                        <option value="{{ $k->id }}">
                                            {{ $k->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-danger">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Photo</label>
                                {{-- <input type="text" placeholder="Masukan photo" class="form-control" name="photo"
                                    id="basicInput" value="{{ old('photo') }}"> --}}
                                <input type="file" class="form-control" name="photo" value="{{ old('photo') }}" id="basicInput">
                            </div>
                            <div class="text-danger">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Gambar</label>

                                <input type="file" class="form-control" name="url" id='url' placeholder=""
                                    value="{{ old('url') }}">

                            </div>
                            <div class="text-danger">
                                @error('url')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control"  name="description"  rows="3"
                                    value="{{ old('description') }}"></textarea>
                            </div>
                            <div class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Summary</label>
                                <textarea class="form-control ckeditor" class="ckeditor" name="summary" id="ckeditor" rows="3"
                                    value="{{ old('summary') }}"></textarea>
                            </div>
                            <div class="text-danger">
                                @error('summary')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control ckeditor" class="ckeditor" name="description" id="ckeditor" rows="3"
                                    value="{{ old('description') }}"></textarea>
                            </div>
                            <div class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Quote</label>
                                <textarea class="form-control ckeditor" class="ckeditor" name="quote" id="ckeditor" rows="3"
                                    value="{{ old('quote') }}"></textarea>
                            </div>
                            <div class="text-danger">
                                @error('quote')
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
