<div class="row">
<div class="espacioTitulosContenido">
        <div class="col-xs-2"> <h2>6.Beneficios  </h2> </div>
        <!--div class="col-xs-1"> <button type="button" class="btn btn-green popAyuda" title="" data-container="body" data-toggle="popover" data-placement="right" data-content="Para el proyecto/tecnología indique la cuantificación de los beneficios en términos de rendimiento, físicos, costos, ambientales y ciclo de vida del producto de acuerdo al mercado identificado." data-original-title="Beneficios.">
            <span class="glyphicon glyphicon-question-sign"></span>
        </button></div-->

        <div class="col-xs-12">
    	<label style="font-style:italic">Para el proyecto/tecnología indique la cuantificación de los beneficios en términos de rendimiento, físicos, costos, ambientales y ciclo de vida del producto de acuerdo al mercado identificado.</label>
   </div>
<div class="col-xs-12 espacioTitulosContenido">

    <textarea name="beneficios" id="beneficios" style="resize: vertical" class="form-control" rows="10"  placeholder="BENEFICIOS:" required></textarea><!--tenia 2 en rows-->
            </div>
        <br>
    </div>



<div class="col-xs-12 espacioTitulosContenido">
<div class="col-xs-4"><h2>7. Riesgos.</h2></div>
       <div class="col-xs-1"><button type="button" class="btn btn-green popAyuda" title="Agregar Riesgos del Proyecto"
              data-container="body" data-toggle="popover" data-placement="right"
              data-content="En esta sección se registran los riesgos del proyecto/tecnologia/prototipo, se describe el riesgo y la mitigación, se pueden registrar uno o varios riesgos completando los campos de información, para registrar al riesgo se debe dar clic en el botón con el simbolo +. Los riesgos del equipo se muestran en la tabla que aparece cuando se registra el primer riesgo.">
              <span class="glyphicon glyphicon-question-sign"></span>
           </button></div>
</div>
<div class="col-xs-12">
<label style="font-style:italic">Describa los riesgos asociados con su proyecto/tecnología, y sus estrategias de mitigación.</label></div>


     <!-- Tabla para agregar usuarios-->
    <div class="col-xs-12">

          <div class="col-xs-3"><label for="Nombre" >Tipo de riesgo</label></div>
          <div class="col-xs-4"><label for="gradoEstudios" >Descripción</label></div>
          <div class="col-xs-4"><label for="areaConocimiento" >Estrategia de mitigación</label></div>

      </div>

    <div class="col-xs-12">

        <div class="col-xs-3"><select id="tipoRiesgo" class="form-control selectpicker" name="tipoRiesgo" data-style="btn-green">
            <option value="-1">Seleccione una opción</option>
            @foreach ($riesgos as $ri)
            <option value="{{$ri->idTipoRiesgo}}"> {{ $ri->descripcion }}</option>
            @endforeach
        </select></div>

        <div class="col-xs-4"><textarea class="form-control" id="descRiesgo" placeholder="Descripción" name="descRiesgo" style="resize: none" title="Se requiere una descripción" required></textarea></div>

        <div class="col-xs-4"><textarea class="form-control" id="estMitigacion" placeholder="Estrategia" name="estMitigacion" style="resize: none" title="Se requiere una estrategia" required="required"></textarea></div>

    </div>
    
    <div class="col-xs-12 text-right">
        <button type="button" class="btn btn-green popAyuda"  title="Agregar Riesgos" onclick="obtenerDatosRiesgos();" style="margin-top: 10px; margin-right: 15px;"data-container="body" data-toggle="popover" data-placement="bottom"
              data-content="Llenar los campos y dar clic para agregar un nuevo Riesgo">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </div>

<div class="col-xs-12" id="contenedorTablaR" style="display:none;padding-top: 20px;">
<table id="altaRiesgo" class="table table--bordered table-hover sortable">
    <thead>
        <tr>
            <th><center>Tipo de riesgo</center></th>
            <th><center>Descripción</center></th>
            <th><center>Estrategia de mitigación</center></th>
            <th><center>Eliminar</center></th>
        </tr>
    </thead>
    <tbody id="contenidoTablaRiesgos" name="contenidoTablaRiesgos">
    <input type='hidden' name='_token' value='{{csrf_token()}}' id='tokenc'>
    </tbody>
</table>
</div>

<div class="col-xs-13 espacioTitulosContenido">
<div class="col-xs-3"><h2>8. Análisis del entorno.</h2></div>
<!--div class="col-xs-1"><button type="button" class="btn btn-green popAyuda" title="Ayuda"
              data-container="body" data-toggle="popover" data-placement="right"
              data-content="Indique el tamaño de la industria a la que va dirigida su proyecto">
              <span class="glyphicon glyphicon-question-sign"></span>
           </button></div-->
</div>

<div class="col-xs-12">
<label style="font-style:italic">Indique el tamaño de la industria a la que va dirigida su tecnología/proyecto, la industria que le proveería sus insumos, clientes/consumidores de su tecnología/proyecto, las tecnologías/proyectos competidores y sus ofertas, y sus factores de demanda.</label>
<textarea name="analisisEnt" id="analisisEnt" style="resize: vertical" class="form-control" rows="10" placeholder= "Indique el tamaño de la industria a la que va dirigida su tecnología" title="Indique el tamaño de la industria" name="analisisEnt" required></textarea><!--tenia 6 en rows-->
<input type="text" value="" id="tokenInademInput" name="tokenInademInput" style="display:none"/>
</div></div>
