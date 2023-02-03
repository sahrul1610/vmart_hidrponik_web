@extends('admin.layouts.template')
@section('title','Edit Produk')
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
                        <label for="basicInput" class="form-label">Basic Input</label>
                        <input type="text" placeholder="Input Here" class="form-control" id="basicInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="withHelperText" class="form-label">With Helper Text Top</label>
                        <small class="text-muted">@description top</small>
                        <input type="text" class="form-control" id="withHelperText">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="disableInput" class="form-label">Disabled Input</label>
                        <input type="password" disabled class="form-control" id="disableInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="withHelperTextBottom" class="form-label">With Helper Text Bottom</label>
                        <input type="text" class="form-control" id="withHelperTextBottom"
                            aria-describedby="withHelperTextBottomHelp">
                        <div id="withHelperTextBottomHelp" class="form-text text-muted">Description Bottom
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="readOnlyInput" class="form-label">Read Only Input</label>
                        <input type="text" value="You can't edit this value" class="form-control" readonly
                            id="readOnlyInput">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="readOnlyInputPlain" class="form-label">Read Only Plain Text</label>
                        <input type="text" value="You can't edit this value" class="form-control-plaintext" readonly
                            id="readOnlyInputPlain">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
