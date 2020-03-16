<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Upload annex</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <input type="file" id="annex-select">
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="input-group">
            <div class="input-group-btn">
                <button id="upload-annex" class="btn btn-danger">Upload</button>
            </div>
            <!-- /btn-group -->
            <input type="text" id="annex-path" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-primary" id="copy-annex-path">Copy</button>
            </span>
        </div>
    </div>
</div>
@push('js')
    <script !src="">
        $('#upload-annex').click(function () {
            let file = $('#annex-select')[0].files[0];
            let formData = new FormData();
            formData.append('annex', file);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: '/annex',
                method: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success:function (response) {
                    $('#annex-path').val(response['path']);
                },
                error:function (response) {
                    alert('Something was wrong')
                    console.log(response)
                }
            })
        })

        $('#copy-annex-path').click(function () {
            $('#annex-path').select();
            document.execCommand('copy');
        })
    </script>
@endpush