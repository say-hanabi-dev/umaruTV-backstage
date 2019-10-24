@extends('backstage.layouts.app')
@section('title','Tag')
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Create</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

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

                    <form action="{{ route('backstage.tag.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="input-group">
                                    <span class="input-group-addon">Tag Name:</span>
                                    <input type="text" class="form-control" required name="name" placeholder="Nmae">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="input-group">
                                    <span class="input-group-addon">Type</span>
                                    <input type="text" class="form-control" required name="type" placeholder="Type">
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                    <br>

                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th style="width: 40px">Label</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}.</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->type }}</td>
                            <td><span class="badge bg-blue">{{ $tag->animes->count() }}</span></td>
                            <td>
                                <button class="btn btn-default" onclick="edit('#edit-{{ $tag->id }}')"><i class="fa fa-edit"></i> Edit</button>
                                <a href="" class="btn btn-primary">View Animation</a>
                                <button class="btn btn-danger" onclick="$('#delete-{{ $tag->id }}').submit()"><i class="fa fa-trash-o"></i> Delete</button>
                                <form id="delete-{{ $tag->id }}" method="post" action="{{ route('backstage.tag.destroy',$tag->id) }}" hidden>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-col" id="edit-{{ $tag->id }}">
                            <form action="{{ route('backstage.tag.update',$tag->id) }}" method="post">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <td>{{ $tag->id }}.</td>
                                <td><input class="form-control" name="name" type="text" value="{{ $tag->name }}"></td>
                                <td><input class="form-control" name="type" type="text" value="{{ $tag->type }}"></td>
                                <td><input class="form-control" type="text" value="{{ $tag->animes->count() }}" disabled></td>
                                <td>
                                    <button class="btn btn-primary">Save</button>
                                    <button class="btn btn-defaulte" onclick="$('#edit-{{ $tag->id }}').hide()">Cancel</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .edit-col{
            display: none;
        }
    </style>
@endsection
@section('js')
    <script>
        function edit(id) {
            $(id).show();
        }
    </script>
@endsection