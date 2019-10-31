@extends("layouts.app")
@section('title','Animation Time Line')
@section('content')
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">新番时间表</h3>
            </div>
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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="{{ $active==1?'active':'' }}"><a href="#tab_1" data-toggle="tab">星期一</a></li>
                        <li class="{{ $active==2?'active':'' }}"><a href="#tab_2" data-toggle="tab">星期二</a></li>
                        <li class="{{ $active==3?'active':'' }}"><a href="#tab_3" data-toggle="tab">星期三</a></li>
                        <li class="{{ $active==4?'active':'' }}"><a href="#tab_4" data-toggle="tab">星期四</a></li>
                        <li class="{{ $active==5?'active':'' }}"><a href="#tab_5" data-toggle="tab">星期五</a></li>
                        <li class="{{ $active==6?'active':'' }}"><a href="#tab_6" data-toggle="tab">星期六</a></li>
                        <li class="{{ $active==7?'active':'' }}"><a href="#tab_7" data-toggle="tab">星期日</a></li>
                        {{--                            <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Tab 2</a></li>--}}
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        @for($i = 1;$i<8;$i++)
                            <div class="tab-pane row {{ $active==$i?'active':'' }}" id="tab_{{ $i }}">
                                @foreach($animes->filter(function ($value)use($i){return $value->update_time == $i;}) as $anime)
                                    <div class="col-md-6 anime-timeline-item">
                                        <img src="{{ $anime->cover }}" class="img-thumbnail">
                                        <a href="{{ route('backstage.anime.edit',$anime->id) }}">{{ mb_substr($anime->name,0,20) }}</a>
                                    </div>
                                @endforeach
                                <div class="col-md-12" style="margin-top: 30px">
                                    <hr style="border:0;background-color:#dadada;height:1px">
                                    <form action="{{ route('backstage.anime.add') }}" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label>添加新番</label>
                                            <div class="input-group">
                                                <select class="form-control select2" name="id" style="width: 100%" required>
                                                    {{--<option selected="selected">Alabama</option>--}}
                                                </select>
                                                <span class="input-group-btn">
                                            <button class="btn btn-info btn-flat" name="update_time" value="{{ $i }}">添加</button>
                                        </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
        </div>
    </div>
@endsection
@push('css_header')
    <link rel="stylesheet" href="{{ asset('./css/select2.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            ajax: {
                url: '{{ route('backstage.anime.search') }}',
                delay:300,
                dataType: 'json',
                cache:true,
                processResults:function (params) {
                    var result = [];
                    for (var i in params){
                        result.push({
                            id:params[i]['id'],
                            text:params[i]['name']
                        })
                    }
                    return {
                        results:result,
                        pagination:false
                    }
                }
            }
        })
    </script>
@endpush