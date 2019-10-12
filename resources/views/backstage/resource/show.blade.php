@extends('backstage.layouts.app')
@section('title',$anime->name.'\'s resource')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$anime->name}}'s {{$episode->name}}</h3>
                <a href="{{ route('backstage.resource.create',$episode->id) }}" class="btn btn-primary pull-right">Add a new Resource to the {{$anime->name}}'s {{$episode->name}}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Resource</th>
                        <th>Type</th>
                        <th style="width: 40px">Resolution</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}.</td>
                            <td>{{ $resource->resource }}</td>
                            <td><span class="badge bg-black">{{ $resource->type }}</span></td>
                            <td><span class="badge bg-purple">{{ $resource->resolution }}</span></td>
                            <td>
                                <a href="{{ route('backstage.resource.edit',$resource->id) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                                <button class="btn btn-primary" onclick="play('{{$resource->resource}}')" data-toggle="modal" data-target="#modal-play"><i class="fa fa-play"></i> Play</button>
                                <button class="btn btn-danger" onclick="$('#delete-{{ $resource->id }}').submit()"><i class="fa fa-trash-o"></i> Delete</button>
                                <form id="delete-{{ $resource->id }}" method="post" action="{{ route('backstage.resource.destroy',$resource->id) }}" hidden>
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                @back(['route'=>route('backstage.episode.index',$anime->id)]) @slot('show') Back @endslot @endback
{{--                {{ $resources->links() }}--}}
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade in" id="modal-play">
        <div class="modal-dialog modal-lg" style="margin-top: 50px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Player</h4>
                </div>
                <div class="modal-body" style="padding: 0;height: 450px">
                    <iframe id="player" src="https://dapian.video-yongjiu.com/share/b70d15bf5840f8e7791e821588d20db3" frameborder="0"></iframe>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('css')
    <style>
        #player{
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('js')
    <script>
        function play(url) {
            url = '{{route('backstage.resource.player')}}?url='+url
            $('#player').attr('src',url)
        }
        $('#player').on('hidden.bs.modal', function (e) {
            console.log('11111')
        })
    </script>
@endsection