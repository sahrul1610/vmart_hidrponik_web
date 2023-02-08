@extends('admin.layouts.template')
@section('title', 'Produk')
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
                                                            {{-- <a href="/buku/detail/{{ $data->id_kategori }}" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a> --}}
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
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure doloribus
                                exercitationem veritatis. Nobis, voluptate praesentium?
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                Lorem ipsum dolor sit amet.
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
