@extends("layouts.app")
@if($resource->id)
    @section('title','Edit Resource '.$anime->name)
@else
    @section('title','Create a new resource')
@endif
@section('content')
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                @if($resource->id)
                    <h3 class="box-title"><i class="fa fa-edit"></i> Edit {{ $anime->name }}-{{$episode->name}}'s resource</h3>
                @else
                    <h3 class="box-title"><i class="fa fa-edit"></i> Create new resource to the {{ $anime->name }}'s {{ $episode->name }}</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if($resource->id)
                @php($route = route('backstage.resource.update',$resource->id))
            @else
                @php($route = route('backstage.resource.store'))
            @endif
            <form role="form" action="{{ $route }}" method="post" enctype="multipart/form-data">
                @if($resource->id)
                    {{ method_field('PUT') }}
                @endif
                {{ csrf_field() }}
                @if(empty($resource->id))
                    <input type="hidden" name="video_id" value="{{ $episode->id }}">
                @endif
                <div class="box-body">
                    @showError @endshowError

                    @input(['name'=>'resource','show'=>'Source','default'=>$resource->resource ])
                    @endinput

                    @select(['name'=>'type'])
                    @slot('option')
                        @option(['value'=>'hls','active'=>$resource->type]) @endoption
                        @option(['value'=>'flv','active'=>$resource->type]) @endoption
                        @option(['value'=>'mp4','active'=>$resource->type]) @endoption
                    @endslot
                    @endselect

                    @select(['name'=>'resolution'])
                    @slot('option')
                        @option(['value'=>1080,'active'=>$resource->resolution]) @slot('show') 1080p @endslot @endoption
                        @option(['value'=>480,'active'=>$resource->resolution]) @slot('show') 720p @endslot @endoption
                        @option(['value'=>720,'active'=>$resource->resolution]) @slot('show') 480p @endslot @endoption
                        @option(['value'=>240,'active'=>$resource->resolution]) @slot('show') 240p @endslot @endoption
                    @endslot
                    @endselect

                    @input(['name'=>'ranking','default'=>$resource->ranking ]) @endinput
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    @back(['route'=>route('backstage.resource.index',$episode->id)]) @endback
                    <button type="submit" class="btn btn-primary pull-right">Sublime</button>
                </div>
            </form>
        </div>
    </div>
@endsection