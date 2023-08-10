var ParArreglo = [];
var RiesArreglo = [];
var banderaTablaParticipate = false;
var banderaTablaRiesgos = false;
var idEquipo = numeroEquipo();
var tokenInadem = localStorage.getItem("tokenAppInadem");

function numeroEquipo()
{
  var caracteres = "1243";
  var contrasena = "";
  for (i=0; i<5; i++) contrasena += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  return contrasena;
}

function obtenerDatosEquipo()
{
    var nombreMiembro = document.getElementById("nomPart").value;

    //validaNombreParticipante(nombreMiembro);

    var comboGradoEstudio = document.getElementById("gradoEstP");
    var gradoEstudio = comboGradoEstudio.options[comboGradoEstudio.selectedIndex].text;
    
    var comboAreaConocimiento = document.getElementById("areaConocimiento");
    var areaConocimiento = comboAreaConocimiento.options[comboAreaConocimiento.selectedIndex].text;

    var correo = document.getElementById("correoPart").value;

    var telefonoMovil = document.getElementById("telPart").value;

    var comboInstitucion = document.getElementById("instPart");
    var institucion = comboInstitucion.options[comboInstitucion.selectedIndex].text;

    var nom = getNombreBien(nombreMiembro);

    var insertaParticipantes=validaParticipantes(nombreMiembro, comboGradoEstudio.value, comboAreaConocimiento.value, correo, telefonoMovil, comboInstitucion.value);

   ParArreglo.push({fk_institucion:parseInt(comboInstitucion.options[comboInstitucion.selectedIndex].value),
                     fk_idGradoEstudios:parseInt(comboGradoEstudio.options[comboGradoEstudio.selectedIndex].value),
                     fk_idAreaConocimientos:parseInt(comboAreaConocimiento.options[comboAreaConocimiento.selectedIndex].value),
                     //fk_direccion:NULL,
                     correoElectronico:correo,
                     nombre:nom[0],
                     apellidoPaterno:nom[1],
                     apellidoMaterno:nom[2],
                     numeroMovil:telefonoMovil,
                     //fechaNacimiento:'0000-00-00',
                     curp:'',
                     genero:0,
                     telefonoFijo:0,
                     numeroControl:'',
                     correoInstitucional:correo,
                     bajaLogica:1
                    });


 if(insertaParticipantes){
    limpiarComponentesParticipate();
     banderaTablaParticipate = true;

    if(banderaTablaParticipate){
      //console.log("Si entra a quitar atributo");
      quitarAtributoParticipantes();
    }
     enviarParticipante();
 }



}


function getNombreBien(nombre){
    var nombreC = nombre.split(" ");
    var nombresArray = new Array(2);
    //console.log("numero de valores "+nombreC.length);

    //obtener apellidos
        nombresArray[2] = nombreC[nombreC.length-1];
            nombresArray[1] = nombreC[nombreC.length-2];

    //obtener nombres
    numeroNombres = nombreC.length-2;
      console.log(numeroNombres);

    switch(numeroNombres){
        case 1:
              nombresArray[0] =nombreC[nombreC.length-3];
            break;
        case 2:
              nombresArray[0] =nombreC[nombreC.length-4]+" "+nombreC[nombreC.length-3];
            break;

        case 3:
              nombresArray[0] =nombreC[nombreC.length-5]+" "+nombreC[nombreC.length-4]+" "+nombreC[nombreC.length-3];
            break;
                        }

     console.log(nombresArray);
     return nombresArray;

}
function obtenerDatosRiesgos()
{

    var comboTipoRiesgo = document.getElementById("tipoRiesgo");
    var tipoRiesgo = comboTipoRiesgo.options[comboTipoRiesgo.selectedIndex].text;

    var descripcion = document.getElementById("descRiesgo").value;

    var estrategiaMitigacion = document.getElementById("estMitigacion").value;
    
    var insertarRiesgos =  validaRiesgos(comboTipoRiesgo.value, descripcion, estrategiaMitigacion);
    
    //console.log("obtenerDatosRiesgos "+insertarRiesgos);

    RiesArreglo.push({fk_idTipoRiesgo:parseInt(comboTipoRiesgo.options[comboTipoRiesgo.selectedIndex].value),
                      estrategiaMitigacion:estrategiaMitigacion,
                      descripcionRiesgo:descripcion,
                      bajaLogica:1});

  if(insertarRiesgos){
      limpiarComponentesRiesgo();
      banderaTablaRiesgos = true;

    if(banderaTablaRiesgos){
        //console.log("Si entra a quitar atributo");
        quitarAtributoRiesgos();
    }
    enviarRiesgos();
  }
}


function eliminarRegistroParticipante(objP)
{
     if(objP.eliminado = 1){

           $('#ModalEliminadoConf').modal('show');

     $('#miembro_'+objP.idParticipante).remove();

     if(objP.numeroRows <= 0){
          $('#contenedorTablaP').css('display', 'none');
     }else{
            $('#contenedorTablaP').css('display', 'block');
     }

         }
}

function eliminarRegistroRiesgo(objR)
{
     if(objR.eliminado = 1){
     $('#riesgo_'+objR.idRiesgo).remove();
          $('#ModalEliminadoConf').modal('show');

         if(objR.numeroRows <= 0){
          $('#contenedorTablaR').css('display', 'none');
     }else{
            $('#contenedorTablaR').css('display', 'block');
     }

     }
}


function limpiarComponentesParticipate() {    
    document.getElementById("nomPart").value="";
    document.getElementById("correoPart").value="";
    document.getElementById("telPart").value="";    
    
    $('#gradoEstP').val('-1');
    $('#areaConocimiento').val('-1');    
    $('#instPart').val('-1');
    
    $('.selectpicker').selectpicker('refresh');    
}

function limpiarComponentesRiesgo() {
    document.getElementById("descRiesgo").value="";
    document.getElementById("estMitigacion").value="";   
    document.getElementById("tipoRiesgo").value="-1";
    
    $('#tipoRiesgo').val('-1');    
    
    $('.selectpicker').selectpicker('refresh');
}


function enviarRiesgos(){

      console.log("entrar a la funcion enviar riesgos  "+JSON.stringify(RiesArreglo));
   // var token = $("#token").val();
    $.ajax({
        url:'insertarRiesgo',
        type: 'POST',
        dataType: 'json',
        data:{riesgo:RiesArreglo,tokenInadem:localStorage.getItem("tokenAppInadem").toString()},
        success: function(success) {
            console.log("Sent values "+success);
            RiesArreglo = [];
            if(success != 0){
                crearTablaRiesgos(success);
            }else{
                mostrarModalError();
            }
      },
error: function(response){
      $("#ModalError").modal("show");
     RiesArreglo = [];
    }
    });
}

function enviarParticipante() {

    console.log("entrar a la funcion enviar participante "+localStorage.getItem("tokenAppInadem") );
   // var token = $("#token").val();
    $.ajax({
        url:'insertarParticipante',
        type: 'POST',
        dataType: 'json',
        data:{participante:ParArreglo,equipo:parseInt(idEquipo),tokenInadem:localStorage.getItem("tokenAppInadem").toString()},
        success: function(success) {
            console.log("Sent values "+JSON.stringify(success));
            //reiniciar el arreglo
            ParArreglo = [];
            if(success != 0){
                crearTablaParticipante(success);
            }else{
                mostrarModalError();
            }

      },
error: function(response){
     $("#ModalError").modal("show");
     ParArreglo = [];
    }
    });
   //event.preventDefault();
}


function crearTablaParticipante(tabla){

    if(tabla != null){
         $('#contenedorTablaP').css('display', 'block');
    }

    var tbodyPart = document.getElementById("cuerpoTabla");
    var trPart = document.createElement('tr');


    jQuery.each(tabla, function(i,val) {
         trPart.id= "miembro_" + val.idParticipante;

    var infoPart = "<td classs='' id='nombreParticipante_"+val.idParticipante +"' name='nombreParticipante_"+ val.idParticipante +"'>"+ val.nombre+' '+val.apellidoPaterno+' '+val.apellidoMaterno+"</td>";

	infoPart += "<td classs='' id='gradoEstudioParticipante_"+val.idParticipante +"' name='gradoEstudioParticipante_"+ val.idParticipante +"'>"+val.nivel+"</td>";

    infoPart += "<td classs='' id='areaConocimientoParticipante_"+ val.idParticipante +"' name='areaConocimientoParticipante_"+ val.idParticipante +"'>"+val.descripcion+"</td>";

    infoPart += "<td classs='' id='correoParticipante_"+val.idParticipante+"' name='correoParticipante_"+val.idParticipante+"'>"+val.correoElectronico+"&nbsp&nbsp"+"</td>";

    infoPart += "<td classs='' id='telefonoMovilParticipante_"+ val.idParticipante +"' name='telefonoMovilParticipante_"+ val.idParticipante+"'>"+ val.numeroMovil+"</td>";

    infoPart += "<td classs='' id='institucionParticipante_"+ val.idParticipante+"' name='institucionParticipante_"+ val.idParticipante +"'>"+ val.nombreInstitucion+"</td>";

	infoPart += "<td classs='' id='botonParticipante_"+ val.idParticipante +"' name='botonParticipante_"+ val.idParticipante +"'>"
            +"<button type='button' class='btn btn-red' onclick='eliminarParticipante("+val.idParticipante+")'>"
            +"<span class='glyphicon glyphicon-remove'></span>"
            +"</button></td>";

          trPart.innerHTML = infoPart;
  tbodyPart.appendChild(trPart);
     });

}

function crearTablaRiesgos(tabla){

     if(tabla != null){
         $('#contenedorTablaR').css('display', 'block');
    }

    var tbody = document.getElementById("contenidoTablaRiesgos");
    var tr = document.createElement('tr');

    jQuery.each(tabla, function(i,val) {
      tr.id= "riesgo_" +val.idRiesgo;

    var info="<td classs='' id='nombreRiesgo_"+ val.idRiesgo+"' name='nombreRiesgo_"+val.idRiesgo +"'>"+ val.descripcion+"</td>";

	info+="<td classs='' id='descripcionRiesgo_"+ val.idRiesgo+"' name='descripcionRiesgo_"+ val.idRiesgo+"'>"+val.descripcionRiesgo+"</td>";
    info+="<td classs='' id='estrategiaMitigacion_"+ val.idRiesgo+"' name='estrategiaMitigacion_"+ val.idRiesgo+"'>"+ val.estrategiaMitigacion+"</td>";

	info += "<td classs='' id='botonRiesgo_"+val.idRiesgo +"' name='botonRiesgo_"+ val.idRiesgo +"'>"
            +"<button type='button' class='btn btn-red' onclick='eliminarRiesgo("+val.idRiesgo+")'>"
            +"<span class='glyphicon glyphicon-remove'></span>"
            +"</button></td>";

  tr.innerHTML = info;
  tbody.appendChild(tr);

    });

}

function eliminarParticipante(idP){
$("#ModalDeleteConf").modal("show");
 console.log("vamos a eliminar a "+idP);
$("#AceptarEliminar2").css("visibility","hidden");
$("#AceptarEliminar").css({"visibility":"visible","position":"absolute"});
$("#AceptarEliminar").click(function(){
              $.ajax({
        url:'eliminarParticipante',
        type: 'POST',
        dataType: 'json',
        data:{idParticipante:parseInt(idP),tokenInadem:localStorage.getItem("tokenAppInadem").toString()},
        success: function(success) {
            console.log("Retorno  "+success);
            eliminarRegistroParticipante(success);


      },
error: function(response){
     $("#ModalEliminadoCancel").modal("show");
    }
    });
        });


}

function eliminarRiesgo(idR){
    $("#ModalDeleteConf").modal("show");
    console.log("id del riesgo ",idR);
    $("#AceptarEliminar").css({"visibility":"hidden","position":"relative"});
$("#AceptarEliminar2").css("visibility","visible");
$("#AceptarEliminar2").click(function(){
   $.ajax({
        url:'eliminarRiesgo',
        type: 'POST',
        dataType: 'json',
        data:{idRiesgo:idR,tokenInadem:localStorage.getItem("tokenAppInadem").toString()},
        success: function(success) {
            console.log("Retorno  "+success);
              eliminarRegistroRiesgo(success);

      },
error: function(response){
    console.log('Error Ajax');
    }
    });

   });
}

function quitarAtributoParticipantes() { 
    
    document.getElementById("nomPart").removeAttribute("required"); 
    document.getElementById("gradoEstP").removeAttribute("required"); 
    document.getElementById("areaConocimiento").removeAttribute("required"); 
    document.getElementById("correoPart").removeAttribute("required"); 
    document.getElementById("telPart").removeAttribute("required"); 
    document.getElementById("instPart").removeAttribute("required"); 
}

function quitarAtributoRiesgos() { 
    document.getElementById("tipoRiesgo").removeAttribute("required"); 
    document.getElementById("descRiesgo").removeAttribute("required"); 
    document.getElementById("estMitigacion").removeAttribute("required"); 
}

function validaParticipantes(nombre, gradoEstudios, areaConocimiento, correo, noCelular, institucion) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    var validaPartci = true;
    
    
    console.log(nombre+" "+gradoEstudios+" "+areaConocimiento+" "+correo+" "+noCelular+" "+institucion);
    
    if(gradoEstudios<0 || areaConocimiento<0 || institucion<0){
        validaPartci=false;
        //console.log("Entro al if....");
        divTexto.innerHTML = "¡Seleccione una opción valida!";
        modal.style.display='block';
    }
    
    if(nombre == null || nombre.length == 0 || correo == null || correo.length == 0|| noCelular == null || noCelular.length==0){
      validaPartci=false;    
      divTexto.innerHTML = "¡Verifique la información ingresada!";
      modal.style.display='block';
    }
    
    if(!validaNombreParticipante(nombre))
          validaPartci=false;  
    
     if(!validaCorreoParticipante(correo))
          validaPartci=false;  
    
     if(!validaCelularParticipante(noCelular))
          validaPartci=false;  

    
    return validaPartci;
}


function validaNombreParticipante(nombreParticipante) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");       
    validaNombre = true;
    
    var tamanoNombre = nombreParticipante.split(' ');
    
    if(!(/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(nombreParticipante)) || tamanoNombre.length<3){
        //console.log("Entra al if ");
        
        divTexto.innerHTML = "¡Nombre incorrecto, por favor verifíquelo!";
        modal.style.display='block';
        validaNombre = false;
    }  
    return validaNombre;
}

function validaCorreoParticipante(correoParticipante) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");       
    validaCorreo = true;
    
    if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(correoParticipante))){
        //console.log("Entra al if ");
        
        divTexto.innerHTML = "¡Correo electrónico incorrecto, por favor verifíquelo!";
        modal.style.display='block';
        validaCorreo = false;
    }   
    return validaCorreo;
}

function validaCelularParticipante(celularParticipante) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");       
    validarCelular = true;    
    if(!(/^\d{10}$/.test(celularParticipante))){
        //console.log("Entra al if ");
        
        divTexto.innerHTML = "¡teléfono incorrecto, por favor verifíquelo deben de ser 10 dígitos!";
        modal.style.display='block';
        validarCelular = false;
    } 
       return validarCelular;
}

function validaRiesgos(tipoRiesgo, descripcion, estrategiaMitigacion) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    var validaRiesgo = true;
    
    
    //console.log(tipoRiesgo+" "+descripcion+" "+estrategiaMitigacion);
    
    if(tipoRiesgo<0){
        //console.log("selects " + validaRiesgo);
        
        validaRiesgo=false;
        divTexto.innerHTML = "¡Seleccione una opción valida!";
        modal.style.display='block';
    }
    
    
    if(descripcion == null || descripcion.length == 0 || estrategiaMitigacion == null || estrategiaMitigacion.length == 0 ){
    //console.log("inputs " + validaRiesgo);

      validaRiesgo=false;    
      divTexto.innerHTML = "¡Verifique la información ingresada!";
      modal.style.display='block';
    }
    
    console.log(validaRiesgo);
    return validaRiesgo;
}

function validaSelects() 
{ 

    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    var validaEnvio = true;

    var institucion = document.getElementById("institucion").value;
    var tipoInvension = document.getElementById("tipoInvension").value;
    
    var trl = document.getElementById("madurezProy").value;
    var sectorEstrategico = document.getElementById("sectorEst").value;
    var estadoActual = document.getElementById("estadoAct").value;
    var tipoProteccion = document.getElementById("tipoProt").value;
    var objetivoProyeecto = document.getElementById("perProy").value;

    console.log(institucion+" "+tipoInvension+" "+trl+" "+sectorEstrategico+" "+estadoActual+" "+tipoProteccion+" "+objetivoProyeecto);
    
    if(institucion<0){
        
        divTexto.innerHTML = "¡Seleccione una institución por favor!";
        modal.style.display='block';
        validaEnvio = false;
    } 
    
    if(tipoInvension<0){
        
        divTexto.innerHTML = "¡Seleccione un tipo invensión por favor!";
        modal.style.display='block';
        validaEnvio = false;

    } 
    
    if(trl<0){
        
        divTexto.innerHTML = "¡Seleccione un TRL por favor!";
        modal.style.display='block';
        validaEnvio = false;

    } 
   
    if(sectorEstrategico<0){
        
        divTexto.innerHTML = "¡Seleccione un sector éstrategico por favor!";
        modal.style.display='block';
        validaEnvio = false;

    } 
    
    if(estadoActual<0){
        
        divTexto.innerHTML = "¡Seleccione un estado actual por favor!";
        modal.style.display='block';
        validaEnvio = false;

    } 
    
    if(tipoProteccion<0){
        
        if(estadoActual === 4 || estadoActual === 5){
        divTexto.innerHTML = "¡Seleccione un tipo de protección por favor!";
        modal.style.display='block';
        validaEnvio = false;
        }

    } 
    
    if(objetivoProyeecto<0){
        
        divTexto.innerHTML = "¡Seleccione un objetivo de proyecto por favor!";
        modal.style.display='block';
        validaEnvio = false;

    } 
    
    if(validaComponentes(objetivoProyeecto)){
        if(validaEnvio)
        $('#ModalConfirmacionForm').modal('show');
        //modalEnvio.style.display='block';
    }

    
}

function validaComponentes(objetivoProyeecto) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    var modalEnvio = document.getElementById("ModalConfirmacionForm");
    var validaEnvio = true;
   // var objetivoProyeecto = document.getElementById("perProy").value;
    
    console.log("Valor de Otro: "+objetivoProyeecto);

    if(objetivoProyeecto==5){
        var otroObjetivoProyecto = document.getElementById("otro_ObjetivoProyecto").value;
        
        if(otroObjetivoProyecto == null || otroObjetivoProyecto.length == 0)
         {
             divTexto.innerHTML = "¡Objetivo de proyecto incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         } 

    }
       
    var titulo = document.getElementById("titulo").value;
    var tituloComercial = document.getElementById("tituloComercial").value;
    var problemaResolver = document.getElementById("problematica").value;
    var descripcionProyecto = document.getElementById("descripcion").value;
    var ies = document.getElementById("desIES").value;
    var analisisEntorno = document.getElementById("analisisEnt").value;
    var rh = document.getElementById("recursosHumanos").value;
    var rt = document.getElementById("recursosTec").value;
    var rf = document.getElementById("recursosFin").value;
    var usosAplicacion = document.getElementById("usoApp").value;
    var viabilidad = document.getElementById("viabilidad").value;
    var beneficios = document.getElementById("beneficios").value;
    //var numeroRegistro = document.getElementById("numeroRegistro").value;


    //console.log(institucion+" "+tipoInvension+" "+trl+" "+sectorEstrategico+" "+estadoActual+" "+tipoProteccion+" "+objetivoProyeecto);
    
     if(titulo == null || titulo.length == 0)
         {
             divTexto.innerHTML = "¡Titulo incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }  
    if(tituloComercial == null || tituloComercial.length == 0)
         {
             divTexto.innerHTML = "¡Titulo comercial incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(problemaResolver == null || problemaResolver.length == 0)
         {
             divTexto.innerHTML = "¡Problema a resolver, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(descripcionProyecto == null || descripcionProyecto.length == 0)
         {
             divTexto.innerHTML = "¡Descripción de proyecto incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(ies == null || ies.length == 0)
         {
             divTexto.innerHTML = "¡IES incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(analisisEntorno == null || analisisEntorno.length == 0)
         {
             divTexto.innerHTML = "¡Análisis de entorno incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(rh == null || rh.length == 0)
         {
             divTexto.innerHTML = "¡Recursos humanos incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(rt == null || rt.length == 0)
         {
             divTexto.innerHTML = "¡Recursos tecnológicos incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(rf == null || rf.length == 0)
         {
             divTexto.innerHTML = "¡Recursos financieros incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }  
    if(usosAplicacion == null || usosAplicacion.length == 0)
         {
             divTexto.innerHTML = "¡Usos/Aplicaciones incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(viabilidad == null || viabilidad.length == 0)
         {
             divTexto.innerHTML = "¡Viabilidad incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    if(beneficios == null || beneficios.length == 0)
         {
             divTexto.innerHTML = "¡Beneficios incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }
    /*if(numeroRegistro == null || numeroRegistro.length == 0 || !(/^[0-9a-zA-Z]+$/.test(numeroRegistro)))
         {
             divTexto.innerHTML = "¡número de registro incorrecto, por favor verifíquelo!";
             modal.style.display='block';
             validaEnvio=false;
         }*/ 
    
return validaEnvio;
    
}

/*function validaNumeroRegistro(numeroRegistro) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");      
    
    var titulo = document.getElementById("titulo").value;
    
    if(!(/[^0-9A-Za-z]/.test(numeroRegistro))){
        //console.log("Entra al if ");
        
        divTexto.innerHTML = "¡numerode registro incorrecto, por favor verifíquelo!";
        modal.style.display='block';
    }  
}*/

function cerrarModal(){
        var modal = document.getElementById("myModal");
        modal.style.display='none';
}


