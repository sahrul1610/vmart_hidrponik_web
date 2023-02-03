@extends("admin.layouts.template")
@section('title', 'Pengguna')
@section('content')

<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Responsive</h4>
                </div>
                <div class="card-body">
                    <p class="form-text mb-2">Datatables also provide responsive table</p>
                    <table id="example" class="table display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>

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
                        {{-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
