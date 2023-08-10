<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use DB;
use App\Proyecto;
use App\TecnologiaProyecto;
use App\Colaboracion;
use App\Riesgos;
use App\AnalisisEntorno;
use App\Participante;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$proyectos = DB::table('tecnologiaproyecto')->select('titulo, descripcion');
        //$proyectos = DB::select('select * from tecnologiaproyecto');
        $proyectos = DB::select('select proy.idProyecto,tp.titulo, inst.nombreInstitucion,ti.descripcion
from proyecto as proy INNER JOIN tecnologiaproyecto as tp ON proy.fk_idTecnologiaProyecto = tp.idTecnologiaProyecto
 INNER JOIN institucion as inst ON tp.fk_idInstitucion=inst.idInstitucion
INNER JOIN tipoinvencion as ti ON tp.fk_idTipoInvencion=ti.idTipoInvencion where proy.bajaLogica = 1'); //Tecnologia::all();
        return view('datatable', ['proyectos'=>$proyectos]);
    }

    public function editar($id){
        $proyecto = Proyecto::find($id);
        if($proyecto){
           return view('detalleProyecto', ["proyecto"=>$proyecto]);
        }else{
            return redirect()->back()->with('nodelete_code', 5);
        }

    }

    public function actualizarProyecto(Request $request){
        //actualizar
        if($request->ajax()){
            //recibe los datos
            $datos = json_decode($request->proyecto);
            $proyecto = Proyecto::find($datos->idProyecto);
            $proyectoTec = TecnologiaProyecto::find($proyecto->fk_idTecnologiaProyecto);
            $proyectoTec->titulo = $datos->titulo;
            $proyectoTec->tituloComercial = $datos->tituloComercial;
            $proyectoTec->problematica = $datos->problematica;
            $proyectoTec->descripcion = $datos->descripcion;
            $proyectoTec->fk_idInstitucion = $datos->idInstitucion;
            $proyectoTec->fk_idTipoInvencion = $datos->idTipoInvencion;
            $proyectoTec->fk_idSector = $datos->sector;
            $proyectoTec->save();

            $proyecto->fk_idPropiedadIntelectual = $datos->propiedadIntelectual;
            $proyecto->fk_idObjetivoProyecto = $datos->objetivoProyecto;
            $proyecto->fk_idTRL = $datos->TRL;
            $proyecto->save();

            //actualiza analisis entorno
            $analisisEntorno = AnalisisEntorno::find($proyecto->fk_idAnalisisEntorno);
            $analisisEntorno->descripcionAnalisisEntorno = $datos->analisisEntorno;
            $analisisEntorno->usoAplicacion = $datos->usoAplicacion;
            $analisisEntorno->viabilidad = $datos->viabilidad;
            $analisisEntorno->beneficios = $datos->beneficios;
            $analisisEntorno->recursosHumanos = $datos->recursosHumanos;
            $analisisEntorno->recursosTecnologicos = $datos->recursosFinancieros;
            $analisisEntorno->recursosFinancieros = $datos->recursosTecnologicos;
            $analisisEntorno->save();

            //Actualiza colaboracion
            $colaboracion = Colaboracion::find($proyecto->fk_idColaboracion);
            $colaboracion->descripcion = $datos->colaboracionIES;
            $colaboracion->save();

            //Actualiza participantes
            $participantes = $users = DB::table('equipoemprendedor')
            ->select('fk_participante')
            ->where('numeroEquipo', '=', $proyecto->fk_numeroEquipoEmprendedor)->get();
            $participantesParam = json_decode(json_encode($datos->participantes), true);
            $index = 0;
            foreach ($participantes as $participanteAux) {
            	$participante = Participante::find($participanteAux->fk_participante);
            	$participante->nombre = $participantesParam[$index]['nombre'];
            	$participante->fk_idGradoEstudios = $participantesParam[$index]['idGradoEstudios'];
            	$participante->fk_idAreaConocimientos = $participantesParam[$index]['idAreaConocimiento'];
            	$participante->correoElectronico = $participantesParam[$index]['correo'];
            	$participante->numeroMovil = $participantesParam[$index]['numeroMovil'];
            	$participante->fk_idInstitucion = $participantesParam[$index]['idInstitucion'];
            	$participante->save();
            	$index++;
            }

            //Actualiza riesgos
            $riesgos = $users = DB::table('riesgo')
            ->select('idRiesgo')
            ->where('fk_idProyecto', '=', $proyecto->idProyecto)->get();
            $riesgosParam = json_decode(json_encode($datos->riesgos), true);
            $index = 0;
            foreach ($riesgos as $riesgoAux) {
            	$riesgo = Riesgos::find($riesgoAux->idRiesgo);
            	$riesgo->fk_idTipoRiesgo = $riesgosParam[$index]['idTipoRiesgo'];
            	$riesgo->estrategiaMitigacion = $riesgosParam[$index]['estrategiaMitigacion'];
            	$riesgo->descripcionRiesgo = $riesgosParam[$index]['descripcionRiesgo'];
            	$riesgo->save();
            	$index++;
            }
            return json_encode("{resultado: Datos actualizados}");
        }
    }

    private function actualizarRiesgo($riesgos,$riesgosParam){
    	
    }
    public function eliminar(Request $request){
        //eliminar
        if($request->ajax()){
        $proyecto = $request->proyecto;
        $deleted =  DB::select('UPDATE proyecto SET proyecto.bajaLogica = 0 where proyecto.idProyecto = '.$proyecto);
        if($deleted == true){
            $valorRetorno = "success";
            }
        else{
            $valorRetorno = "not success";
        }


             return json_encode("{resultados:".$valorRetorno."}");
        }

        //redirigir a AdminController@Index
    }
}
