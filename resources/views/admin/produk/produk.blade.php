@if(auth()->user()->roles == 'ADMIN')
@extends('admin.layouts.template')
@section('title','Produk')
@section('content')
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Basic</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            <a href="{{url('produk/add')}}" class="btn btn-primary">
                                <i class="ti-plus"></i>
                                tes</a>
                        </p>
                        <div class="table-responsive">
                            <table id="example2" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>tag</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$dt->name}}</td>
                                            <td>{{$dt->price}}</td>
                                            <td>{{$dt->description}}</td>
                                            <td>{{$dt->tags}}</td>
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
@endsection
@endif
