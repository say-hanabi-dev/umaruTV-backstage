@extends("backstage.layouts.app")
@section('title','Edit: '.$anime->name)
@section('content')
    <div class="col-md-7">
        <div class="box box-primary">

            <div class="box-header with-border">
                @if($anime->id)
                    <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
                @else
                    <h3 class="box-title"><i class="fa fa-edit"></i> Create</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if($anime->id)
                <form role="form" action="{{ route('backstage.anime.update',$anime->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
            @else
                <form role="form" action="{{ route('backstage.anime.store') }}" method="post" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                <div class="box-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="form-group @error('name') has-error @enderror">
                        <label for="InputName">Name</label>
                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter Name" value="{{ $anime->name }}">
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @error('release_time') has-error @enderror">
                        <label>Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="release_time" class="form-control pull-right" id="datepicker" value="{{ $anime->release_time }}">
                        </div>
                        @error('release_time')
                        <span class="help-block">{{ $message }}</span>
                    @enderror
                    <!-- /.input group -->
                    </div>
                    <div class="form-group @error('status') has-error @enderror">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="updating" {{ $anime->status=='updating'?'selected':''}}>Updating</option>
                            <option value="end" {{ $anime->status=='end'?'selected':''}}>The end</option>
                            <option value="stop" {{ $anime->status=='stop'?'selected':''}}>Stop</option>
                        </select>
                        @error('status')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @error('introduction') has-error @enderror">
                        <label>Introduction</label>
                        <textarea class="form-control" name="introduction" rows="3" placeholder="Enter ...">{{ $anime->introduction }}</textarea>
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @error('cover') has-error @enderror">
                        <label for="inputCover">Cover input</label>
                        @if($anime->cover)
                            <img src="{{ asset($anime->cover) }}" class="img-thumbnail cover">
                        @endif
                        <input type="file" name="cover" id="InputCover">
                        @error('cover')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    @back(['route'=>route('backstage.anime.index')]) @endback
                    <button type="submit" class="btn btn-primary pull-right">Sublime</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd',
        })
    </script>
@endpush