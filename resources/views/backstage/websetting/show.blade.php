@extends('layouts.app')
@section('title','Website Setting')
@section('content')
    <div class="col-md-10">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Website Setting</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('backstage.websetting.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    @foreach($setting as $set)
                        <div class="form-group">
                            <label for="Input{{ $set->name }}">{{ $set->description . ': ' . $set->name }}</label>
                            <input type="text" class="form-control on-click-push" data-name="{{ $set->id }}" id="Input{{ $set->key }}" value="{{ $set->value }}">
                        </div>
                    @endforeach
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-2">
        @component('layouts.components.annex')  @endcomponent
    </div>
@endsection
@push('js')
    <script>
        $('.on-click-push').change(function (obj) {
            $(this).attr('name',$(this).data('name'))
        });
    </script>
@endpush