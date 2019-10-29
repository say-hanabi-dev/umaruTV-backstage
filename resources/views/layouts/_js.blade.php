{{--<!-- FastClick -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>--}}

{{--<!-- Sparkline -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>--}}
{{--<!-- jvectormap  -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
{{--<!-- SlimScroll -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>--}}
{{--<!-- ChartJS -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/bower_components/chart.js/Chart.js"></script>--}}
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/dist/js/pages/dashboard2.js"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="https://adminlte.io/themes/AdminLTE/dist/js/demo.js"></script>--}}
<script>
    function submiteOnHasValue(obj) {
        var inputs = $(obj).parents('form').find('input');
        for(var i=0;i<inputs.length;i++){
            if($(inputs[i]).val()){
                inputs[i].name = $(inputs[i]).data('name');
            }
        }
    }
</script>
@stack('js')