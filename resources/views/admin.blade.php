<html>
    <head>
        <title>Banco Nacional de Proyectos</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css">
         <link href="{{ asset('/css/format.css') }}" rel="stylesheet" type="text/css">
         <link href="{{ asset('/css/ie.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            @include('header')
        </div>

        <!-- tabla de admin -->
        <div class="container">
            @include('datatable')
        </div>

        <div class="container">
            @include('footer')
        </div>
    </body>

    <!-- Select -->
<!--
<script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>
-->
<script type="text/javascript" src="{{asset('/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/codigoSelect.js') }}"></script>

</html>
