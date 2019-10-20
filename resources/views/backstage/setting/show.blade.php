@extends('backstage.layouts.app')
@section('title','Backstage Setting')
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Backstage Setting</h3>
                <a class="btn btn-primary pull-right" href="{{ route('backstage.setting.create') }}">Add Settings</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('backstage.setting.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    @foreach($setting as $set)
                        <div class="form-group">
                            <label for="Input{{ $set->key }}">{{ ucfirst($set->key) }}</label>
                            <input type="text" class="form-control on-click-push" data-name="{{ $set->id }}" id="Input{{ $set->key }}" placeholder="{{ $set->comment }}" value="{{ $set->value }}">
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="">Upload file</label><br>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" id="select-file" class="btn btn-info">Select a file to upload</button>
                                <button type="button" id="upload-file" class="btn btn-primary">Upload</button>
                                {{-- <button type="button" class="btn btn-default">Copy path</button>--}}
                            </div>
                            <!-- /btn-group -->
                            <input type="text" id="upload-path" class="form-control">
                        </div>
                        <input type="file" id="file-input" style="display: none">
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
@section('js')
    <script>
        $('.on-click-push').change(function (obj) {
            $(this).attr('name',$(this).data('name'))
        });

        $('#select-file').click(function () {
            $('#file-input').trigger('click')
        });
        $('#upload-file').click(function () {
            var file = document.getElementById('file-input').files[0];
            if(file){
                var files = $('#file-input').prop('files');

                var data = new FormData();
                data.append('upload_file', files[0]);
                data.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: '{{ route('backstage.upload') }}',
                    type: 'POST',
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success:function (response) {
                        $('#upload-path').val(response.path)
                    }
                });

            }
        });
        $('#file-input').change(function () {
            var file = document.getElementById('file-input').files[0];
            if(file){
                $('#select-file').html(file.name)
            }else{
                $('#select-file').html('Select a file to upload')
            }
        })
    </script>
@endsection