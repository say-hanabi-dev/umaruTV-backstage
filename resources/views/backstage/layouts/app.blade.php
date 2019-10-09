<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('/js/app.js') }}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('backstage.layouts._header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('backstage.layouts._sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            content
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('backstage.layouts._footer')

    @include('backstage.layouts._hiddenSidebar')

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>


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

</body>
</html>
