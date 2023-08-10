   function openModal(Tipo){
        if(Tipo === 1){
              //obtener el id del proyecto
             $.ajax({
        url:'obtenerIdProyecto',
        type: 'GET',
        dataType: 'json',
        data:{},
        success: function(success) {
            $( "#ModalLoginForm .modal-body" ).append( "<p>Su numero de proyecto es "+success.idProyecto+" por favor guardelo para consultas previas del proyecto.</p>" );
            if(success.length !== 0){
                $('#ModalLoginForm').modal('show');
            }
      },
error: function(response){
    console.log("Error en el ajax de obtener id proyecto");
    }
    });



        }else{
             $('#ModalLoginFormE').modal('show');
        }

    }
    function validaTexto(){
        var contadorTextos = 0;
        var txt,txt2,txt3,txt4,txt5,txt6,txt7,txt8,txt9,txt10,txt11,txt12,txt13,txt13,txt14,txt15,txt16,txt17,txt18,txt19;
        var titulo = $("#titulo").val().length;
        var tituloC = $("#tituloComercial").val().length;
        var problematica = $("#problematica").val().length;
        var descripcion = $("#descripcion").val().length;
        var nomPart = $("#nomPart").val().length;
        var correoPart = $("#correoPart").val().length;
        var telPart = $("#telPart").val().length;

        var numeroRegistro = $("#numeroRegistro").val().length;
        var otro= $("#otro_ObjetivoProyecto").val().length;

        var desIES = $("#desIES").val().length;
        var descRiesgo = $("#descRiesgo").val().length;
        var estMitigacion = $("#estMitigacion").val().length;
        var analisisEnt= $("#analisisEnt").val().length;

        var recursosHumanos =$("#recursosHumanos").val().length;
        var recursosTec= $("#recursosTec").val().length;
        var recursosFin=$("#recursosFin").val().length;
        var usoApp = $("#usoApp").val().length;
        var viabilidad=$("#viabilidad").val().length;
        var beneficios=$("#beneficios").val().length;

        if(titulo < 0){
         contadorTextos = contadorTextos + 1;
        }else{
            txt = $("<p></p>").text("Falta campo Titulo");
        }
        if(tituloC < 0){
            contadorTextos = contadorTextos + 1;
        }else{
           txt2 = $("<p></p>").text("Falta campo Titulo Comercial");
        }
        if(problematica < 0){
            contadorTextos = contadorTextos + 1;
        }else{
             txt3 = $("<p></p>").text("Falta campo Problematica");
        }
        if(descripcion < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt4 = $("<p></p>").text("Falta campo Descripción");
        }
        if(nomPart < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt5 = $("<p></p>").text("Falta campo Nombre en participante");
        }
        if(correoPart < 0){
            contadorTextos = contadorTextos + 1;
        }else{
           txt6 = $("<p></p>").text("Falta campo Correo en participante");
        }
        if(telPart < 0){
            contadorTextos = contadorTextos + 1;
        }else{
           txt7 = $("<p></p>").text("Falta campo Numero movil en participante");
        }
        if(numeroRegistro < 0){
            contadorTextos = contadorTextos + 1;
        }else{
          txt8 = $("<p></p>").text("Falta campo Numero de Registro");
        }
        if(otro < 0){
            contadorTextos = contadorTextos + 1;
        }else{
           txt9 = $("<p></p>").text("Falta campo Otro en que persigue el proyecto");
        }
        if(desIES < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt10 = $("<p></p>").text("Falta campo Colaboración con otras IES");
        }
        if(descRiesgo < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt11 = $("<p></p>").text("Falta campo Descripción en riesgos");
        }
         if(estMitigacion < 0){
            contadorTextos = contadorTextos + 1;
        }else{
             txt12 = $("<p></p>").text("Falta campo Estrategia de mitigación en riesgos");
        }
         if(analisisEnt < 0){
            contadorTextos = contadorTextos + 1;
        }else{
             txt13 = $("<p></p>").text("Falta campo Analisis del entorno");
        }
         if(recursosHumanos < 0){
            contadorTextos = contadorTextos + 1;
        }else{
              txt14 = $("<p></p>").text("Falta campo Recursos Humanos en recursos");
        }
        if(recursosTec < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt15 = $("<p></p>").text("Falta campo Recursos Tecnologicos en recursos");
        }
         if(recursosFin < 0){
            contadorTextos = contadorTextos + 1;
        }else{
             txt16 = $("<p></p>").text("Falta campo Recursos Financieros en recursos");
        }
        if(usoApp < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt17 = $("<p></p>").text("Falta campo Usos / Aplicaciones ");
        }
        if(viabilidad < 0){
            contadorTextos = contadorTextos + 1;
        }else{
             txt18 = $("<p></p>").text("Falta campo Viabilidad");
        }
        if(beneficios < 0){
            contadorTextos = contadorTextos + 1;
        }else{
            txt19 = $("<p></p>").text("Falta campo Beneficios");
        }

        //verificar cuantos campos se han llenado a traves del campo otro
        var seleccionOtro = $("select[name=perProy]").val();
        if(seleccionOtro === "5"){
             if(contadorTextos == 20){
        $('#ModalConfirmacionForm').modal('show');
        }else{

$("#contenidoAlerta").append(txt,txt2,txt3,txt4,txt5,txt6,txt7,txt8,txt9,txt10,txt11,txt12,txt13,txt13,txt14,txt15,txt16,txt17,txt18,txt19);
            $(".alert").addClass('in out');
        }
        }else{
             if(contadorTextos == 19){
        $('#ModalConfirmacionForm').modal('show');
        }else{

$("#contenidoAlerta").append(txt,txt2,txt3,txt4,txt5,txt6,txt7,txt8,txt10,txt11,txt12,txt13,txt13,txt14,txt15,txt16,txt17,txt18,txt19);
            $(".alert").addClass('in out');
        }
        }


    }

   // $('#bsalert').on('close.bs.alert', toggleAlert);

    function mostrarModalError(){
     $('#ModalLoginForm').modal('show');
     }
