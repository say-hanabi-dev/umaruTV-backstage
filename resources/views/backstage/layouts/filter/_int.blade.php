<div class="form-group">
    <label>{{ $column['name'] }}</label>
    <div style="padding-left: 10px;">
        <div class="row" style="margin-right: 0">
            <div class="col-lg-4" style="padding: 0">
                <div class="input-group">
                    <span class="input-group-addon">Min</span>
                    <input type="text" name="{{ $column['field'] }}_min" class="form-control" value="{{ request($column['field'].'_min') }}">
                </div>
                <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-4" style="padding: 0">
                <div class="input-group">
                    <span class="input-group-addon">Max</span>
                    <input type="text" name="{{ $column['field'] }}_max" class="form-control" value="{{ request($column['field'].'_max') }}">
                </div>
                <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
    </div>
</div>