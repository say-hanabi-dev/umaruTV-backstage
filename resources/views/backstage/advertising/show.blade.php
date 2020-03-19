@extends('layouts.app')
@section('title','Advertising')
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

                <form action="{{ route('backstage.ad.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon">Name:</span>
                                <select class="form-control" required name="name">
                                    <option selected value="carousel">Home page carousel</option>
{{--                                    <option>option 2</option>--}}
{{--                                    <option>option 3</option>--}}
{{--                                    <option>option 4</option>--}}
{{--                                    <option>option 5</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <span class="input-group-addon">Image:</span>
                                <input type="text" class="form-control" required name="image" placeholder="Image">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <span class="input-group-addon">Link:</span>
                                <input type="text" class="form-control" required name="link" placeholder="Link">
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
                        <th>Image</th>
                        <th>Link</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($ads as $ad)
                        <tr>
                            <td>{{ $ad->id }}.</td>
                            <td>{{ $ad->name }}</td>
                            <td><a target="_blank" href="{{ $ad->image }}">{{ $ad->image }}</a></td>
                            <td><a target="_blank" href="{{ $ad->link }}">{{ $ad->link }}</a></td>
                            <td>
                                <button class="btn btn-default" onclick="edit('#edit-{{ $ad->id }}')"><i class="fa fa-edit"></i> Edit</button>
                                <button class="btn btn-danger" onclick="$('#delete-{{ $ad->id }}').submit()"><i class="fa fa-trash-o"></i> Delete</button>
                                <form id="delete-{{ $ad->id }}" method="post" action="{{ route('backstage.tag.destroy',$ad->id) }}" hidden>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <tr class="edit-col" id="edit-{{ $ad->id }}">
                            <form action="{{ route('backstage.ad.update',$ad->id) }}" method="post">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <td>{{ $ad->id }}.</td>
                                <td><input class="form-control" name="name" type="text" value="{{ $ad->name }}"></td>
                                <td><input class="form-control" name="image" type="text" value="{{ $ad->image }}"></td>
                                <td><input class="form-control" name="link" type="text" value="{{ $ad->link }}"></td>
                                <td>
                                    <button class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-defaulte"  onclick="$('#edit-{{ $ad->id }}').hide()">Cancel</button>
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
@push('css')
    <style>
        .edit-col{
            display: none;
        }
    </style>
@endpush
@push('js')
    <script>
        function edit(id) {
            $(id).show();
        }
    </script>
@endpush