@extends('admin.layouts.template')
@section('title', 'Tambah Produk')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <form role="form" action="/posts/update" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Judul</label>
                                <input type="text" placeholder="Masukan nama judul" name="title" class="form-control"
                                    id="basicInput" value="{{ $post->title }}">
                            </div>
                            <div class="text-danger">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">kategori</label>
                                <select class="js-example-basic-single form-select form-select-sm" name="category_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($categories as $k)
                                        @if ($k->id == $post->category_id)
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
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="photo" value="{{ $post->photo }}"
                                    id="basicInput">
                            </div>
                            <div class="text-danger">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Link youtube</label>
                                <input type="text" class="form-control" name="url"
                                    value="{{ old('url', 'https://www.youtube.com/watch?v=' . $post->url) }}"
                                    id="basicInput">
                            </div>
                            <div class="text-danger">
                                @error('url')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Ringkasan</label>
                                <textarea class="form-control ckeditor" class="ckeditor" name="summary" id="ckeditor" rows="3">{{ $post->summary }}</textarea>
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
                                <textarea class="form-control ckeditor" class="ckeditor" name="description" id="ckeditor" rows="3">{{ $post->description }}</textarea>
                            </div>
                            <div class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Kutipan</label>
                                <textarea class="form-control ckeditor" class="ckeditor" name="quote" id="ckeditor" rows="3">{{ $post->quote }}</textarea>
                            </div>
                            <div class="text-danger">
                                @error('quote')
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
