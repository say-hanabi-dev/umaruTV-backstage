@extends("backstage.layouts.app")
@if($episode->id)
    @section('title','Edit Episode'.$anime->name)
@else
    @section('title','Create new Episode')
@endif
@section('content')
    <div class="col-md-7">
        <div class="box box-primary">

            <div class="box-header with-border">
                @if($episode->id)
                    <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
                @else
                    <h3 class="box-title"><i class="fa fa-edit"></i> Create new episode to the {{ $anime->name }}</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if($episode->id)
                <form role="form" action="{{ route('backstage.episode.update',$episode->id) }}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @else
                        <form role="form" action="{{ route('backstage.episode.store') }}" method="post" enctype="multipart/form-data">
                            @endif
                            {{ csrf_field() }}
                            @if(empty($episode->id))
                                <input type="hidden" name="anime_id" value="{{ $anime->id }}">
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
                                    @if($episode->id)
                                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter Name" value="{{ $episode->name }}">
                                    @else
                                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter Name" value="第{{ $anime->episodes+1 }}集">
                                    @endif
                                    @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('info') has-error @enderror">
                                    <label for="InputInfo">Introduction</label>
                                    <input type="text" name="info" class="form-control" id="InputInfo" placeholder="Enter introduction" value="{{ $episode->info }}">
                                    @error('info')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group @error('ranking') has-error @enderror">
                                    <label for="InputInfo">Ranking</label>
                                    @if($episode->id)
                                        <input type="text" name="ranking" class="form-control" id="InputInfo" placeholder="Enter introduction" value="{{ $episode->ranking }}">
                                    @else
                                        <input type="text" name="ranking" class="form-control" id="InputInfo" placeholder="Enter introduction" value="{{ $anime->episodes+1 }}">
                                    @endif
                                    @error('ranking')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                @back(['route'=>route('backstage.episode.index',$anime->id)])
                                @endback
                                <button type="submit" class="btn btn-primary pull-right">Sublime</button>
                            </div>
                        </form>
        </div>
    </div>
@endsection