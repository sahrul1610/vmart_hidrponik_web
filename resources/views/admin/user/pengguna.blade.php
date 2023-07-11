@extends("admin.layouts.template")
@section('title', 'Pengguna')
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($data as $dt)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$dt->name}}</td>
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
