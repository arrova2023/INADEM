<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Banco Nacional de Proyectos</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css">
        <!-- Custom CSS -->
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/format.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/ie.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>
         <script type="text/javascript" src="{{asset('/js/bootstrap.js')}}"></script>
    <!-- Confirmacion de eliminacion de registros -->
        <script type="text/javascript" src="{{ URL::asset('js/confEliminar.js') }}"></script>
</head>
 <body>
        <div class="container">
            @include('headerEditar')
        </div>


     <div id="ModalProyActualizado" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Proyecto actualizado</h1>
            </div>
            <div class="modal-body">
               Proyecto actualizado exitosamente.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

     <div id="ModalProyNoActualizado" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Actualizacion fallida</h1>
            </div>
            <div class="modal-body">
               Intenta nuevamente, no se ha podido actualizar el proyecto.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<h1 align="center">Editar Proyecto</h1>
    <!-- Aquí se manda a llamar el el .blade.php en donde se tienen que cargar el query de los proyectos para poder actualizarlos en caso de ser necesario. -->
    
        <div class="container">
            @include('modificar')
        </div>


        <div class="container">
            @include('footerEditar')
        </div>
</body>
 <script type="text/javascript" src="{{ asset('/js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/codigoSelect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popOver.js') }}"></script>
       
    <script type="text/javascript" src="{{ asset('/js/ajaxValidacion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/tableMembers.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sorttable.js') }}"></script>
</html>
