
	$(function () {
       ///  pop over
		$("[data-toggle='popover']").popover({ trigger: "hover" });

        ///valida el select otro
        $("select[name=perProy]").change(function(){

            valor = $(this).val();

            if(valor === "5"){

                $('#otroBloque').css('display', 'block');
            }else{

                $('#otroBloque').css('display', 'none');
            }

        });

          $("select[name=estadoAct]").change(function(){

            valor = $(this).val();
              console.log("valor ",valor);

           if(valor === "4" || valor === "5"){

                $('#bloquePatente').css('display', 'block');
            }else{

                $('#bloquePatente').css('display', 'none');
            }

        });


	});
