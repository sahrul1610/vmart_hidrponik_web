@extends('admin.layouts.template')
@section('title', 'Tambah Produk')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Default Form</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Nama</label>
                            <input type="text" placeholder="Input Here" class="form-control" id="basicInput">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Harga</label>
                            <input type="text" placeholder="Input Here" class="form-control" id="basicInput">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">kategori</label>
                            <select class="js-example-basic-single form-select form-select-sm" name="category_id"  multiple>
                                <option value="">- Pilih -</option>
                                @foreach($kategori as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Tag</label>
                            <input type="text" placeholder="Input Here" class="form-control" id="basicInput">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
<!-- js for select only -->
<script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script>
<script src="{{ url('/template') }}/plugins/select2/dist/js/select2.min.js"></script>
    <!-- ======= -->
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2({
                placeholder:'- Pilih -'
            });
        });
    </script>
@endsection
