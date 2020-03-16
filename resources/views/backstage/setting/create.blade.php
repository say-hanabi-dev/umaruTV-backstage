@extends('layouts.app')
@section('title','Backstage Setting')
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Backstage Setting</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('admin.setting.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="InputKey">Key</label>
                        <input type="text" class="form-control" name="key" id="InputKey" required>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="InputValue">Value</label>
                        <input type="text" class="form-control" name="value" id="InputValue">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="InputComment">Comment</label>
                        <input type="text" class="form-control" name="comment" id="InputComment">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="InputType">Type</label>
                        <input type="text" class="form-control" name="type" id="InputType">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection