<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Tecnologia;
use App\Institucion;
use App\Proyecto;
use App\PropiedadIntelectual;
use App\AnalisisEntorno;
use App\ObjetivoProyecto;
use App\Colaboracion;
use App\EquipoEmprendedor;
use App\Participante;
use App\Riesgos;
use App\TokenIna;
use App\TipoInvencion;
use App\TipoGradoEstudios;
use App\AreaConocimiento;
use App\Trl;
use App\TipoSector;
use App\TipoPropiedadIntelectual;
use App\TipoObjetivoProyecto;
use App\TipoProteccion;
use App\TipoRiesgo;
use Log;



class InademController extends Controller
{

  public function tokenInademApp(Request $request){

    if($request->ajax()){
      $dato =$request->llave;
      $llavecita = new TokenIna;
      $llavecita->llave=$dato;
      $llavecita->nombreEquipo = gethostbyaddr($_SERVER['REMOTE_ADDR']);
      $llavecita->ipEquipoCliente = $request->ipEquipo;
      $llavecita->save();

      return response()->json('almacenado');
    }

  }

  public function insertarParticipante(Request $request){


     //modelo de la tabla Participante
    if($request->ajax()){

    $dato =$request->participante; // This will get all the request data.
    $dato2 =$request->equipo;
    $tokenValue = $request->tokenInadem;

    $participante = new Participante;
    $equipo = new EquipoEmprendedor;


         //consulta a la tabla token, el nombre del equipo y token
    $idTec = DB::select('select idToken from tokeninadem WHERE llave ="'.$tokenValue.'" AND nombreEquipo ="'.gethostbyaddr($_SERVER['REMOTE_ADDR']).'"');
    $result = json_decode(json_encode($idTec), true);


    foreach($dato as $d){
               $participante->fk_idInstitucion = $d["fk_institucion"];//$request->input('fk_institucion');
               $participante->fk_idGradoEstudios = $d['fk_idGradoEstudios'];
               $participante->fk_idAreaConocimientos = $d['fk_idAreaConocimientos'];
               //$participante->fk_idDireccion = $d['fk_idDireccion'];
               $participante->correoElectronico =$d['correoElectronico'];
               $participante->nombre = $d['nombre'];
               $participante->apellidoPaterno = $d['apellidoPaterno'];
               $participante->apellidoMaterno = $d['apellidoMaterno'];
               $participante->numeroMovil = $d['numeroMovil'];
               //$participante->fechaNacimiento = $d['fechaNacimiento'];
               $participante->curp = $d['curp'];
               $participante->genero = $d['genero'];
               $participante->telefonoFijo = $d['telefonoFijo'];
               $participante->numeroControl =$d['numeroControl'];
               $participante->correoInstitucional = $d['correoInstitucional'];
               $participante->bajaLogica = $d['bajaLogica'];
              // $participante->fk_idTecnologiaProyecto = $idTec;
          // $participante->fk_idTokenAppIn = $result;


             }
             foreach($result as $i){
               $participante->fk_idTokenAppIn = $i['idToken'];

               $idT = $i['idToken'];
             }

             $saved = $participante->save();
             if($saved){
              
            //ingresar al equipo emprendedor
             //Tabla equipo emprendedor
              $EquipoQuery = DB::select('select idParticipante from participante WHERE participante.fk_idTokenAppIn='.$idT);
              
              $resultEquipo = json_decode(json_encode($EquipoQuery), true);
              foreach($resultEquipo as $i){
               $equipo->fk_participante = $i['idParticipante'];
               $equipo->bajaLogica =1;
               $equipo->numeroEquipo = $dato2;
             }
             $savedEq = $equipo->save();
             if($savedEq){
            //consultar los valores insertados.
              $participanteQuery = DB::select('select participante.idParticipante,participante.nombre,participante.apellidoPaterno,participante.apellidoMaterno,participante.correoElectronico,participante.numeroMovil,
                tipogradoestudios.nivel,areaconocimiento.descripcion,institucion.nombreInstitucion from participante INNER JOIN tipogradoestudios
                ON participante.fk_idGradoEstudios=tipogradoestudios.idGradoEstudios
                INNER JOIN institucion
                ON institucion.idInstitucion=participante.fk_idInstitucion
                INNER JOIN areaconocimiento
                ON areaconocimiento.idAreaConocimiento=participante.fk_idAreaConocimientos
                WHERE
                participante.fk_idTokenAppIn  = '.$idT.' order by participante.idParticipante');
              $insertados = $participanteQuery;
            }else{
             $insertados = 0;
           }
         }else {
    // Whooops
          $insertados = 0;
        }
        return response()->json($insertados);

      }

    }
    public function insertarRiesgo(Request $request){
          //modelo de la tabla Riesgo

      if($request->ajax()){
       $riesgo = new Riesgos;
       $dato = $request->riesgo;
       $tokenValue = $request->tokenInadem;
       foreach($dato as $d){

               $riesgo->fk_idTipoRiesgo = $d["fk_idTipoRiesgo"];//$request->input('fk_institucion');
               $riesgo->estrategiaMitigacion = $d['estrategiaMitigacion'];
               $riesgo->descripcionRiesgo = $d['descripcionRiesgo'];
               $riesgo->bajaLogica=$d['bajaLogica'];


             }

             $token = DB::select('select idToken from tokeninadem WHERE llave ="'.$tokenValue.'" AND nombreEquipo ="'.gethostbyaddr($_SERVER['REMOTE_ADDR']).'"');

             $result = json_decode(json_encode($token), true);
             foreach($result as $i){
              $riesgo->fk_idTokenAppIn = $i['idToken'];
              $idTokenResult = $i['idToken'];
            }

            $saved = $riesgo->save();

            if($saved){
    //consultar los valores insertados
              $insertados = DB::select('select riesgo.idRiesgo,riesgo.descripcionRiesgo, riesgo.estrategiaMitigacion,tiporiesgo.descripcion from riesgo INNER JOIN tiporiesgo on tiporiesgo.idTipoRiesgo = riesgo.fk_idTipoRiesgo INNER JOIN tokeninadem ON riesgo.fk_idTokenAppIn = tokeninadem.idToken where riesgo.fk_idTokenAppIn ='.$idTokenResult.' order by riesgo.idRiesgo');

            }
            else {
    // Whooops
              $insertados = 0;
            }
            return response()->json($insertados);
          }

        }


        public function eliminarParticipante(Request $request){
          if($request->ajax()){
            $dato =$request->idParticipante;
            $tokenValue = $request->tokenInadem;

            $saved = DB::select("DELETE FROM participante WHERE idParticipante = ".$dato);
            $consultarIdEM = DB::select("SELECT equipoemprendedor.idEquipoEmprendedor FROM `equipoemprendedor` WHERE equipoemprendedor.fk_participante = ".$dato);
            $idEq = json_decode(json_encode($consultarIdEM), true);
            foreach($idEq as $i){
              $idEQ = $i['idEquipoEmprendedor'];
            }
       //eliminar participante del equipo
            $actualizarEquipoEmp = DB::select('DELETE FROM equipoemprendedor WHERE equipoemprendedor.idEquipoEmprendedor = '.$idEQ);

            if($saved){
              $envio = 1;

            }else{

              $envio = 0;
            }
            $token = DB::select('select idToken from tokeninadem WHERE llave ="'.$tokenValue.'"');
            $resultToken = json_decode(json_encode($token), true);
            foreach($resultToken as $i){
              $tk = $i['idToken'];
            }

    //saber el numero de registro que existen
            $numeroRegistros = DB::select('SELECT COUNT(*) FROM participante WHERE fk_idTokenAppIn='.$tk);
            $rowsNum = json_decode(json_encode($numeroRegistros), true);
            foreach($rowsNum as $i){
              $rowNumber = $i["COUNT(*)"];
            }
            return response()->json(['eliminado'=>$envio,'idParticipante'=>$dato,'numeroRows'=>$rowNumber]);
          }
        }
        public function eliminarRiesgo(Request $request){
         if($request->ajax()){
          $dato =$request->idRiesgo;
          $tokenValue  = $request->tokenInadem;

          $saved = DB::select("DELETE FROM riesgo WHERE idRiesgo = ".$dato);

          if($saved){
            $envio = 1;
          }else{
            $envio = 0;
          }
          $token = DB::select('select idToken from tokeninadem WHERE llave ="'.$tokenValue.'"');
          $resultToken = json_decode(json_encode($token), true);
          foreach($resultToken as $i){
            $tk = $i['idToken'];
          }

    //saber el numero de registro que existen
          $numeroRegistros = DB::select('SELECT COUNT(*) FROM riesgo WHERE fk_idTokenAppIn='.$tk);
          $rowsNum = json_decode(json_encode($numeroRegistros), true);
          foreach($rowsNum as $i){
            $rowNumber = $i["COUNT(*)"];
          }

          return response()->json(['eliminado'=>$envio,'idRiesgo'=>$dato,'numeroRows'=>$rowNumber]);
        }
      }

    ///desplegar vista desde el controlador 
      public function ver()
    { /// Consulta los catalogos de la BD 

      
      ///////////PARTE 0///////////
        //--- catalogo Institucion---//
      $institucion = DB::select('select * from institucion');
        //--- catalogo TipoInvencion---//
      $inv = DB::select('select * from tipoinvencion');

       ///////////PARTE 1///////////
        //--- catalogo gradoEstudios---//
      $gradoEstudios = DB::select('select * from tipogradoestudios');
        //--- catalogo areaConocimiento---//
      $areaConocimiento = DB::select('select * from areaconocimiento');
      
          ///////////PARTE 2 y 3///////////
        //--- catalogo TRL---//
      $TRL = DB::select('select * from trl');
        //--- catalogo Sector---//
      $sector = DB::select('select * from tiposector');
      
         ///////////PARTE 4 y 5///////////
        //--- catalogo propiedad intelectual---//
      $propInt = DB::select('select * from tipopropiedadintelectual');
        //--- catalogo propiedad intelectual 2 pendiente ---//
      $prot = DB::select('select * from tipoproteccion');
      
         ///////////PARTE 6///////////
        //--- catalogo objetivo proyecto ---//
      $objProy = DB::select('select * from tipoobjetivoproyecto');
      
      
      
         ///////////PARTE 7///////////
        //--- catalogo riesgos---//
      $riesgos = DB::select('select * from tiporiesgo');
      
      
      
        //mostrar vista y catalogos 
      return view('index',['institucion' => $institucion,'inv' => $inv,"gradoEstudios" => $gradoEstudios,"areaConocimiento" => $areaConocimiento,"TRL" => $TRL,"sector" => $sector,"propInt" =>  $propInt,"objProy" => $objProy,"prot" =>  $prot,"riesgos" => $riesgos]);
    }

    //validando formularios en laravel
    public function insertar(Request $request)
    {
     //recuperar valores escritos en los campos
    //Objetos para los inserts
     $tecnologia = new Tecnologia;
     $proyecto = new Proyecto;
     $propInt = new PropiedadIntelectual;
     $anEnt = new AnalisisEntorno;
     $objP= new ObjetivoProyecto;
     $col = new Colaboracion;
     $riesgo = new Riesgos;

    $tokenValue = Input::get("tokenInademInput");


     /*TOKEN DE LA SESION DEL FORMULARIO */
     $token = DB::select('select idToken from tokeninadem WHERE llave ="'.$tokenValue.'" AND nombreEquipo ="'.gethostbyaddr($_SERVER['REMOTE_ADDR']).'"');
     $resultT = json_decode(json_encode($token), true);
     foreach($resultT as $i){
      $idToken = $i['idToken'];
    }
    if(empty($idToken)){
       //print_r("Esta vacia");
         return redirect()->back()->with('error_code', 5);
    }else{
    /* Tabla tecnologia  */
    $tecnologia->titulo = Input::get('titulo');
    $tecnologia->tituloComercial = Input::get('tituloComercial');
    $tecnologia->problematica = Input::get('problematica');
    $tecnologia->descripcion =  Input::get('descripcion');
    //llave foranea
    $tecnologia->fk_idInstitucion = Input::get('instEq');
    $tecnologia->fk_idTipoInvencion = Input::get('tipoInv');
    $tecnologia->fk_idSector = Input::get("sectorEst");
    $tecnologia->bajaLogica = 1;


     //Tabla propiedad intelectual
    $propInt->fk_idTipoRegistro =  Input::get("estadoAct");
    $propInt->fk_idTipoProteccion = Input::get("tipoProt");
      $propInt->numeroRegistro = "";//Input::get("numeroRegistro");
      $propInt->bajaLogica =1;

     //Tabla analisisEntorno
      $anEnt->descripcionAnalisisEntorno=Input::get('analisisEnt');
      $anEnt->usoAplicacion=Input::get('usoApp');
      $anEnt->viabilidad=Input::get('viabilidad');
      $anEnt->beneficios=Input::get('beneficios');
      $anEnt->bajaLogica=1;
      $anEnt->recursosHumanos=Input::get('recursosHumanos');
      $anEnt->recursosTecnologicos=Input::get('recursosTec');
      $anEnt->recursosFinancieros=Input::get('recursosFin');

     //Tabla objetivoProyecto
      $objP->fk_idTipoObjetivoProyecto=Input::get('perProy');
      $objP->otraDescripcion=Input::get('otro_ObjetivoProyecto');
      $objP->bajaLogica=1;



    //Tabla colaboracion
     //obtener el id del ultimo equipo emprendedor que se registro
      $fkEquipoQuery = DB::select('select idEquipoEmprendedor from equipoemprendedor ORDER BY idEquipoEmprendedor DESC LIMIT 1 ');
      $resultIdEq = json_decode(json_encode($fkEquipoQuery), true);
      
     //obtener la primera escuela registrada de los participantes del equipo emprendedor
      $fkEqInstQuery = DB::select('SELECT participante.fk_idInstitucion FROM `participante` WHERE participante.fk_idTokenAppIn ='.$idToken.' ORDER BY  participante.fk_idInstitucion desc limit 1');
      $resultInP = json_decode(json_encode($fkEqInstQuery), true);
      foreach($resultInP as $i){
        foreach($resultIdEq as $k){
          $idEqEmp = $k['idEquipoEmprendedor'];
          $idIPrimerInst= $i['fk_idInstitucion'];
          $col->fk_idInstitucion=$idIPrimerInst;
          $col->descripcion = Input::get('desIES');
          $col->fk_idEquipoEmprendedor = $idEqEmp;
          $col->bajaLogica = 1;

        }
        
      }

      $saved=  $tecnologia->save();
      $saved1= $anEnt->save();
      $saved3= $propInt->save();
      $saved4= $objP->save();
      $saved5= $col->save();

      //Tabla proyecto
     if(empty($idEqEmp)){
       //print_r("Esta vacia");
         return redirect()->back()->with('error_code', 5);
      }else{

      if($saved && $saved1  && $saved3 && $saved4 && $saved5){
       //obtener el ultimo id de la tabla colaboracion
       $idColaboracionQuery = DB::select('SELECT colaboracion.idColaboracion FROM `colaboracion` ORDER BY  idColaboracion desc limit 1');
       $resultQC = json_decode(json_encode($idColaboracionQuery), true);
       foreach($resultQC as $i){
        $idC= $i['idColaboracion'];
      }
     //obtener el ultimo id de la tabla propiedad intelectual
      $idPIQuery = DB::select('SELECT propiedadintelectual.idPropiedadIntelectual FROM `propiedadintelectual` ORDER BY idPropiedadIntelectual  desc limit 1');
      $resultQPI = json_decode(json_encode($idPIQuery), true);
      foreach($resultQPI as $i){
        $idPi= $i['idPropiedadIntelectual'];
      }
     //obtener el ultimo id de la tabla objetivo proyecto
      $idOPQuery = DB::select('SELECT objetivoproyecto.idObjetivoProyecto FROM `objetivoproyecto` ORDER BY idObjetivoProyecto  desc limit 1');
      $resultQOP = json_decode(json_encode($idOPQuery), true);
      foreach($resultQOP as $i){
        $idOp= $i['idObjetivoProyecto'];
      }

        //obtener el ultimo id de la tabla analisis del entorno
      $idAeQuery = DB::select('SELECT analisisentorno.idAnalisisEntorno FROM `analisisentorno` ORDER BY idAnalisisEntorno  desc limit 1');
      $resultQAE = json_decode(json_encode($idAeQuery), true);
      foreach($resultQAE as $i){
        $idAe= $i['idAnalisisEntorno'];
      }

     //obtener el ultimo id de la tabla tecnologia proyecto
      $idTpQuery = DB::select('SELECT tecnologiaproyecto.idTecnologiaProyecto FROM `tecnologiaproyecto` ORDER BY idTecnologiaProyecto desc limit 1');
      $resultQTP = json_decode(json_encode($idTpQuery), true);
      foreach($resultQTP as $i){
        $idTp= $i['idTecnologiaProyecto'];
      }
     //obtener el numero de equipo
      $idNumEqQuery = DB::select('SELECT equipoemprendedor.numeroEquipo FROM `equipoemprendedor`WHERE equipoemprendedor.idEquipoEmprendedor = '.$idEqEmp.' ORDER BY numeroEquipo desc limit 1');
      $resultQIDEQ = json_decode(json_encode($idNumEqQuery), true);
      foreach($resultQIDEQ as $i){
        $idNumEQ= $i['numeroEquipo'];
      }

     //$proyecto->fk_idEquipoEmprendedor=$idEqEmp;
      $proyecto->fk_numeroEquipoEmprendedor = $idNumEQ;
      $proyecto->fk_idColaboracion = $idC;
      $proyecto->fk_idPropiedadIntelectual=$idPi;
      $proyecto->fk_idObjetivoProyecto =$idOp;
      $proyecto->fk_idAnalisisEntorno=$idAe;
      $proyecto->fk_idTRL = Input::get('madurezProy');
      $proyecto->fk_idTecnologiaProyecto=$idTp;
      $proyecto->bajaLogica = 1;

      $savedProyecto = $proyecto->save();

      if($savedProyecto){
              //obtener el id de proyecto
        $idProyectoQuery = DB::select('select idProyecto from proyecto order by idProyecto desc limit 1');
        $resultIdProy = json_decode(json_encode($idProyectoQuery), true);
        foreach($resultIdProy as $i){
          $idProy= $i['idProyecto'];
          }

     ///actualizar tabla riesgos para saber a que proyecto pertenecen

     $actualizarRiesgos = DB::table('riesgo')
            ->where('fk_idTokenAppIn',$idToken)
            ->update(array('fk_idProyecto' => $idProy));


     //    DB::select('UPDATE riesgo SET riesgo.fk_idProyecto ='.$idProy.' where riesgo.fk_idTokenAppIn = '.$idToken);

      // print_r(json_decode(json_encode($actualizarRiesgos), true));
        //    print_r("valor del token ".$idToken);
          //  print_r("valor del id proyecto".$idProy);
      //return redirect()->back();
      if(!empty($actualizarRiesgos)){
          return redirect()->back()->with('success_code', 5);
          }else{
          return redirect()->back()->with('error_code', 5);
      }
      }else{
        return redirect()->back()->with('error_code', 5);
      }


      
    }
        else{
     return redirect()->back()->with('error_code', 5);

         }
     }
    }
 }
 
  public function editar($id){

  //Se obtiene el proyecto con el id
  $sql = "select * from proyecto INNER join tecnologiaproyecto on proyecto.fk_idTecnologiaProyecto  = tecnologiaproyecto.idTecnologiaProyecto where proyecto.idProyecto = ".$id;
  $proyecto = DB::select($sql);
  if($proyecto){
    $instituciones = Institucion::all();
    $invenciones = TipoInvencion::all();
    $participantes = DB::table('equipoemprendedor')->join('participante', 'equipoemprendedor.fk_participante','=','participante.idParticipante')->select('participante.*')->where('equipoemprendedor.numeroEquipo', '=', $proyecto[0]->fk_numeroEquipoEmprendedor)->get();
    $gradosEstudios = TipoGradoEstudios::all();
    $areasconocimiento = AreaConocimiento::all();
    //$trls = DB::table('proyecto')->join('trl','proyecto.fk_idTRL', '=', 'trl.idTRL')->select('trl.*')->where('proyecto.fk_idTRL', '=', $proyecto[0]->fk_idTRL)->get();
    $trls = Trl::all();
    $sectores = TipoSector::all();
    //$sector = TipoSector::find($proyecto[0]->fk_idSector);
    //$tipopropiedadintelectual = TipoPropiedadIntelectual::all();

    $propiedadIntelectual = TipoPropiedadIntelectual::all();
    //$propiedadintelectual = TipoPropiedadIntelectual::find($proyecto[0]->fk_idPropiedadIntelectual);}
    //$propiedadIntelectual = DB::table('propiedadintelectual')
   // ->join('proyecto','propiedadintelectual.fk_idTipoProteccion', '=', 'proyecto.idProyecto')
    //->join('tipoproteccion','propiedadintelectual.fk_idTipoProteccion', '=', 'tipoproteccion.idTipoProteccion')
    //->select('propiedadintelectual.*','tipoproteccion.*')->where('proyecto.fk_idPropiedadIntelectual', '=', $proyecto[0]->idProyecto)->get();

    $objetivosProyecto = TipoObjetivoProyecto::all();
    $tiposProteccion = TipoProteccion::all();
    //$TipoSector = DB::table('')
    
    $analisisentorno = DB::table('proyecto')->join('analisisentorno', 'proyecto.fk_idAnalisisEntorno', '=', 'analisisentorno.idAnalisisEntorno')->select('analisisentorno.*')->where('proyecto.fk_idAnalisisEntorno', '=', $proyecto[0]->fk_idAnalisisEntorno)->get();

    $colaboracion = DB::table('proyecto')->join('colaboracion', 'proyecto.fk_idColaboracion', '=', 'colaboracion.idColaboracion')->select('colaboracion.*')->where('proyecto.fk_idColaboracion', '=', $proyecto[0]->fk_idColaboracion)->get();

    //return json_encode($proyecto);

    $riesgos = DB::table('riesgo')
    ->join('proyecto', 'riesgo.fk_idProyecto', '=', 'proyecto.idProyecto')
    ->join('tiporiesgo','riesgo.fk_idTipoRiesgo', '=', 'tiporiesgo.idTipoRiesgo')
    ->select('riesgo.*', 'tiporiesgo.*')->where('riesgo.fk_idProyecto', '=', $proyecto[0]->idProyecto)->get();

    $tiporiesgos = TipoRiesgo::all(); 

    return view('editar', ["proyecto"=>$proyecto, "instituciones"=>$instituciones, "invenciones"=>$invenciones, "participantes"=>$participantes, "gradosestudios"=>$gradosEstudios, "areasconocimiento"=>$areasconocimiento, "trls"=>$trls, "sectores"=>$sectores,"propiedadIntelectual"=>$propiedadIntelectual, "objetivosProyecto"=>$objetivosProyecto, "tiposProteccion"=>$tiposProteccion, "analisisentorno"=>$analisisentorno, "colaboracion"=>$colaboracion,"riesgos"=>$riesgos, "tiporiesgos"=>$tiporiesgos,]); 

  }else{

    return redirect()->back()->with('noEdit_code', 5);

  }

  }

   public function obtenerIdProyecto(Request $request){
       if($request->ajax()){
        $idProyectoQuery = DB::select('select idProyecto from proyecto order by idProyecto desc limit 1');
        $resultIdProy = json_decode(json_encode($idProyectoQuery), true);
        foreach($resultIdProy as $i){
          $idProy= $i['idProyecto'];
          }

       return response()->json(['idProyecto'=>$idProy]);
       }
   }

}
