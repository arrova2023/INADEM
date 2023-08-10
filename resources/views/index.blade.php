*<html>
    <head>
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
    </head>
    <body>
        <div class="container">
            @include('header')
        </div>

<!--
  mensaje de introduccion-->
        <div class="container">
            @include('introduccion')
        </div>


        {!! Form::open(array('action' => 'InademController@insertar')) !!}


<div class="alert alert-danger fade out" id="bsalert">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <div id="contenidoAlerta"></div>
</div>

            <!--Inicio Modal-->
 <div class="modal" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" style="left:0;">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" onclick="cerrarModal();" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
              </div>
              <div id="setTexto" class="modal-body">
              </div>
              <div class="modal-footer">
              </div>
         </div>
    </div>
</div>   

       <!--Fin Modal-->  
        

            <!--Tecnologia o Proyecto y Equipo Emprendedor o Inventor-->
            <div class="container">
                @include('tecnologiaEquipoEmprendedor')
            </div>
            <!--Estado de proyecto, sector estrategico , propiedad intelectual y lo que persigue el proyecto-->
            <div class="container">
                @include('estadoProyecto')
            </div>
            <div class="container">
                @include('colaboracionIES')
            </div>
            <div class="container">
                @include('recursosAplicacion')
            </div>


            <div class="container" style="padding-bottom:60px">


                <div class="row col-xs-12" id="botones">
                    <div class="col-xs-6">


      <!--- data-toggle="modal" data-target="#ModalLoginForm" -->
        <button  type="button" class="btn btn-success btn-lg" onclick="validaSelects();" style="left: 80%;position: relative;" >
          <span class="glyphicon glyphicon-ok"></span> Aceptar
        </button>

                    </div>

                    <div class="col-xs-6">

       <button type="reset" class="btn btn-danger btn-lg">
          <span class="glyphicon glyphicon-remove"></span> Cancelar
        </button>

                    </div>
                </div>
            </div>


<!-- Modal HTML Markup -->
<div id="ModalConfirmacionForm" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro</h1>
            </div>
            <div class="modal-body">
               Realmente esta seguro de guardar esta información
            </div>
             <div class="modal-footer">
         <button  type="submit" class="btn btn-success btn-lg">
          <span class="glyphicon glyphicon-ok"></span> Aceptar
        </button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro</h1>
            </div>
            <div class="modal-body">
               Almacenamiento de información exitosa.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="ModalError" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro</h1>
            </div>
            <div class="modal-body">
              Intente nuevamente por favor
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="ModalLoginForm2" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro</h1>
            </div>
            <div class="modal-body">
              Almacenamiento incorrecto. Intenta nuevamente por favor
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                 
                        
<div id="ModalEliminadoConf" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro Eliminado</h1>
            </div>
            <div class="modal-body">
               Se ha eliminado con exito el registro seleccionado.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        <div id="ModalEliminadoCancel" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro Eliminado</h1>
            </div>
            <div class="modal-body">
              No se puede eliminar el registro seleccionado, intente nuevamente por favor.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="ModalDeleteConf" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Eliminar registro</h1>
            </div>
            <div class="modal-body">
              ¿Realmente desea eliminar el registro?
            </div>
             <div class="modal-footer">
         <button id="AceptarEliminar" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
         <button id="AceptarEliminar2" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




        {!! Form::close() !!}

        <div class="container">
            @include('footer')
        </div>



    </body>

    <!-- Select -->

    <script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/codigoSelect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/popOver.js') }}"></script>
       <script type="text/javascript">
     $(document).ready(function(){

      $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


function generar()
{
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<100; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  return contraseña;
}

         //obtiene la direccion IP:
    function getIPs(callback){
        var ip_dups = {};

        //compatibilidad exclusiva de firefox y chrome, el usuario @guzgarcia compartio este enlace muy util: http://iswebrtcreadyyet.com/
        var RTCPeerConnection = window.RTCPeerConnection
            || window.mozRTCPeerConnection
            || window.webkitRTCPeerConnection;
        var useWebKit = !!window.webkitRTCPeerConnection;

        //bypass naive webrtc blocking using an iframe
        if(!RTCPeerConnection){
            //NOTE: necesitas tener un iframe in la pagina, exactamente arriba de la etiqueta script
            //
            //<iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
            //<script>... se llama a la funcion getIPs aqui...
            //
            var win = iframe.contentWindow;
            RTCPeerConnection = win.RTCPeerConnection
                || win.mozRTCPeerConnection
                || win.webkitRTCPeerConnection;
            useWebKit = !!win.webkitRTCPeerConnection;
        }

        //requisitos minimos para conexion de datos
        var mediaConstraints = {
            optional: [{RtpDataChannels: true}]
        };

        var servers = {iceServers: [{urls: "stun:stun.services.mozilla.com"}]};

        //construccion de una nueva RTCPeerConnection
        var pc = new RTCPeerConnection(servers, mediaConstraints);

        function handleCandidate(candidate){
            // coincidimos con la direccion IP
            var ip_regex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
            var ip_addr = ip_regex.exec(candidate)[1];

            //eliminamos duplicados
            if(ip_dups[ip_addr] === undefined)
               callback(ip_addr);

            ip_dups[ip_addr] = true;
        }

        //escuchamos eventos candidatos
        pc.onicecandidate = function(ice){

            //dejamos de lado a los eventos que no son candidatos
            if(ice.candidate)
                handleCandidate(ice.candidate.candidate);
        };

        //creamos el canal de datos
        pc.createDataChannel("");

        //creamos un offer sdp
        pc.createOffer(function(result){

            //disparamos la peticion (request) al stun server (para entender mejor debemos ver la documentacion de WebRTC.
            pc.setLocalDescription(result, function(){}, function(){});

        }, function(){});

        //esperamos un rato para dejar que todo se complete:
        setTimeout(function(){
            //leemos la informacion del candidato desde la descripcion local
            var lines = pc.localDescription.sdp.split('\n');

            lines.forEach(function(line){
                if(line.indexOf('a=candidate:') === 0)
                    handleCandidate(line);
            });
        }, 1000);
    }


function guardarToken(clave){
 getIPs(function(ip){

     $.ajax({
        url:'tokenInademApp',
        type: 'POST',
        dataType: 'json',
        data:{llave:clave,ipEquipo:ip},
        success: function(success) {
            console.log("llave Temporal "+success);


      },
error: function(response){
    console.log('Error'+response);
    }
    });

         });


}

    //valores temporales

        var tokenInadem = generar();
        guardarToken(tokenInadem);
  //almacenarlo en localstorage
        localStorage.clear();
        localStorage.setItem("tokenAppInadem", tokenInadem);
         //añadir tokenAppInaddem a input
           console.log("Session ::: ",localStorage.getItem("tokenAppInadem"));
           $("#tokenInademInput").val(localStorage.getItem("tokenAppInadem").toString());

     });

   </script>

    <script type="text/javascript" src="{{ asset('/js/tableMembers.js') }}"></script>
     <script type="text/javascript" src="{{ asset('/js/ajaxValidacion.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sorttable.js') }}"></script>
@if(!empty(Session::get('success_code')) && Session::get('success_code') == 5)

<script>
openModal(1);
</script>
@endif
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
openModal(2);
</script>
@endif


</html>
