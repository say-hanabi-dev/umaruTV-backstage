@extends('backstage.layouts.app')
@section('title',$anime->name.'\'s episodes')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$anime->name}}</h3>
            <a href="{{ route('backstage.episode.create',$anime->id) }}" class="btn btn-primary pull-right">Add a new episode to the animation: {{$anime->name}}</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Info</th>
                        <th style="width: 40px">Coin</th>
                        <th>Resource</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($episodes as $episode)
                        <tr>
                            <td>{{ $episode->id }}.</td>
                            <td>{{ $episode->name }}</td>
                            <td>{{ $episode->info }}</td>
                            <td><span class="badge bg-gray">{{ $episode->coin }}</span></td>
                            <td><span class="badge bg-blue">{{ $episode->resource->count() }}</span></td>
                            <td>
                                <a href="{{ route('backstage.episode.edit',$episode->id) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
{{--                                <a href="{{ route('backstage.episode.index',$episode->id) }}" class="btn btn-primary">View episode</a>--}}
                                <button class="btn btn-danger" onclick="$('#delete-{{ $episode->id }}').submit()"><i class="fa fa-trash-o"></i> Delete</button>
                                <form id="delete-{{ $episode->id }}" method="post" action="{{ route('backstage.episode.destroy',$episode->id) }}" hidden>
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
                {{ $episodes->links() }}
            </div>
        </div>
    </div>
@endsection