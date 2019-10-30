@extends("layouts.app")
@section('title','Edit: '.$anime->name)
@section('content')
    <div class="col-md-7">
        <div class="box box-primary">

            <div class="box-header with-border">
                @if($anime->id)
                    <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
                    <a href="{{ route('backstage.episode.index',$anime->id) }}" class="btn btn-primary pull-right">View Episode</a>
                @else
                    <h3 class="box-title"><i class="fa fa-edit"></i> Create</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if($anime->id)
                @php $route = route('backstage.anime.update',$anime->id)@endphp
            @else
                @php $route = route('backstage.anime.store') @endphp
            @endif
            <form role="form" action="{{ $route }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if($anime->id)
                    {{ method_field('PUT') }}
                @endif
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
                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter Name" value="{{ ee(old('name'),$anime->name) }}">
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
                            <input type="text" name="release_time" class="form-control pull-right" id="datepicker" value="{{ ee(old('release_time'),$anime->release_time) }}">
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
                        <textarea class="form-control" name="introduction" rows="3" placeholder="Enter ...">{{ ee(old('introduction'),$anime->introduction) }}</textarea>
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tag</label>
                        <select class="form-control select2" name="tag_id[]" multiple="multiple" data-placeholder="Select a Tag" style="width: 100%;">
                            @if($anime->id)
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ $anime->tags->find($tag)?'selected':''}} >{{ $tag->name }}</option>
                                @endforeach
                            @else
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" >{{ $tag->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group @error('cover') has-error @enderror">
                        <label for="inputCover">Cover input</label>
                        <input type="text" name="cover" class="form-control" id="InputName" placeholder="Enter File path" value="{{ ee(old('cover'),$anime->cover) }}">
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                        @if($anime->cover)
                            <img src="{{ asset($anime->cover) }}" class="img-thumbnail cover">
                        @endif
                        <input type="file" name="cover_file" id="InputCover">
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
@push('css_header')
    <link rel="stylesheet" href="{{ asset('./css/select2.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();

        $('#datepicker').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd',
        })
    </script>
@endpush