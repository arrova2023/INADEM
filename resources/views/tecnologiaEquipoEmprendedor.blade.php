<!-- Bloque cero y uno -->
  <div class="row">
   <div class="espacioTitulosContenido">
    <div class="col-xs-4"><h2>0. Tecnología / proyecto / prototipo</h2></div>
     <!--div class="col-xs-1"><button type="button" class="btn btn-green popAyuda" title="Ayuda"
              data-container="body" data-toggle="popover" data-placement="right"
              data-content="Captura la información solicitada del proyecto o tecnologia que estas desarrollando">
              <span class="glyphicon glyphicon-question-sign"></span>
           </button></div-->
    </div>

            	<!-- Input titulo -->
                <div class="col-xs-12" style="padding-top: 20px;">
                    <div class="col-xs-2"><label for="titulo" >Título:</label></div>
                    <div class="col-xs-10"><textarea style="resize: vertical" class="form-control"  required id="titulo" rows="1" placeholder="Título del proyecto o tecnología" name="titulo"></textarea></div>
                </div>
            	<!-- Input titulo comercial -->
              	<div class="col-xs-12" style="padding-top: 20px;">
                	 <div class="col-xs-2"><label for="tituloComercial">Título comercial:</label></div>
                	 <div class="col-xs-10"><textarea style="resize: vertical"Nombre class="form-control" required id="tituloComercial" rows="1" placeholder="Título comercial del proyecto o tecnología" name="tituloComercial"></textarea></div>
              	</div>
            	<!-- Input problematica -->
              	<div class="col-xs-12" style="padding-top: 20px;">
                	<div class="col-xs-2"><label for="problematica">Problemática a resolver:</label></div>
                	<div class="col-xs-10"><textarea style="resize: vertical" class="form-control" required id="problematica" placeholder="Describir la problemática que resolverá" name="problematica" rows="10"></textarea></div>
              	</div>
                <!-- Input descripcion -->
              	<div class="col-xs-12" style="padding-top: 20px;">
                	<div class="col-xs-2"><label for="descripcion">Descripción / resumen:</label></div>
                	<div class="col-xs-10"><textarea style="resize: vertical" class="form-control" required id="descripcion" rows="10" placeholder="Descripción o resumen del proyecto/tecnología/prototipo" name="descripcion"></textarea></div>
              	</div>

            <div class="col-xs-12" style="padding-top: 20px;">
                	<div class="col-xs-2"><label for="name">Institución:</label></div>
                	<div class="col-xs-4"><select id="institucion" required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-green" name="instEq">
                        <option value="-1">Seleccione una opción</option>
                  		@foreach ($institucion as $int)
                        <option value="{{$int->idInstitucion}}"> {{ $int->nombreInstitucion }}</option>
                        @endforeach
                	</select>
                    </div>
            </div>

            <div class="col-xs-12" style="padding-top: 20px;">
                	<div class="col-xs-2"><label for="name">Tipo de invención:</label></div>
                	<div class="col-xs-4"><select required id="tipoInvension" class="form-control selectpicker" data-style="btn-green" name="tipoInv">
                        <option value="-1">Seleccione una opción</option>
                  		@foreach ($inv as $in)
                        <option value="{{$in->idTipoInvencion}}"> {{ $in->descripcion }}</option>
                        @endforeach
                	</select>
                    </div>
            </div>

    <div class="col-xs-12" style="padding-top: 20px;"></div>

   <div class="espacioTitulosContenido">
    <div class="col-xs-4"><h2>1. Equipo emprendedor</h2></div>
       <div class="col-xs-1"><button type="button" class="btn btn-green popAyuda" title="Agregar integrantes al equipo emprendedor"
              data-container="body" data-toggle="popover" data-placement="right"
              data-content="En esta sección se registran los integrantes del equipo emprendedor que desarrolló el proyecto/tecnologia/prototipo, se requiere el nombre(s) y apellidos, se pueden registrar uno o varios integrantes completando los campos de información, para registrar al integrante se debe dar clic en el botón con el simbolo +. Los integrantes del equipo se muestran en la tabla que aparece cuando se registra el primer integrante.">
              <span class="glyphicon glyphicon-question-sign"></span>
           </button></div>
    </div>

      <!-- Tabla para agregar usuarios-->
      <!---mostrar si hay datos en la tabla -->
      <div class="col-xs-12">

          <div class="col-xs-2"><label for="Nombre" >Nombre completo:</label></div>

          <div class="col-xs-2"><label for="gradoEstudios" >Último grado de estudios</label></div>

          <div class="col-xs-2"><label for="areaConocimiento" >Área de conocimiento</label></div>

          <div class="col-xs-2"><label for="correo" >Correo electrónico:</label></div>

          <div class="col-xs-2"><label for="noCelular" >Número celular:</label></div>

          <div class="col-xs-2"><label for="intitucion" >Institución</label></div>

      </div>

      <div class="col-xs-12">
          <div class="col-xs-2"><input type="text" class="form-control" required id="nomPart" placeholder="Nombre(s) y Apellidos" name="nomPart"/></div>

          <div class="col-xs-2"><select id="gradoEstP" required class="form-control selectpicker" data-style="btn-green" name="gradoEstP">
              <option value="-1" id="raiz">Seleccione una opción</option>
              @foreach ($gradoEstudios as $grado)
              <option value="{{$grado->idGradoEstudios}}"> {{ $grado->nivel }}</option>
              @endforeach
          </select></div>

          <div class="col-xs-2"><select id="areaConocimiento" required class="form-control selectpicker" data-style="btn-green" name="areaConocimiento">
              <option value="-1">Seleccione una opción</option>
               @foreach ($areaConocimiento as $areaC)
               <option value="{{$areaC->idAreaConocimiento}}"> {{ $areaC->descripcion }}</option>
               @endforeach
          </select></div>

          <div class="col-xs-2"><input type="email" required class="form-control" id="correoPart" placeholder="correo@mail.mx" name="correoPart"/>
          </div>

          <div class="col-xs-2"><input type="tel" required class="form-control" id="telPart" placeholder="Maximo 10 digitos" name="telPart"/>
          </div>

          <div class="col-xs-2"><select id="instPart" required class="form-control selectpicker" data-style="btn-green" data-size="10" data-live-search="true" name="instPart">
             <option value="-1">Seleccione una opción</option>
              @foreach ($institucion as $ti)
              <option value="{{$ti->idInstitucion}}"> {{ $ti->nombreInstitucion }}</option>
              @endforeach
          </select></div>


      </div>

      <div class="col-xs-12 text-right">
        <button type="button" class="btn btn-green popAyuda" title="Agregar Integrante" onclick="obtenerDatosEquipo();" style="margin-top: 10px; margin-right: 15px;"  data-container="body" data-toggle="popover" data-placement="bottom"
              data-content="Llenar los campos y dar clic para agregar al nuevo Emprendedor/Inventor al equipo.">
             <span class="glyphicon glyphicon-plus"></span>
        </button>
      </div>


      <div class="col-xs-12" id="contenedorTablaP" style="display:none;padding-top: 20px;">
        <table id="altaEquipo" class="table table--bordered table-hover sortable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Último grado de estudios</th>
                    <th>Área de conocimiento</th>
                    <th>Correo electrónico</th>
                    <th>Número celular personal</th>
                    <th>Institución</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla" name="contenidoTabla">
             <input type='hidden' name='_token' value='{{csrf_token()}}' id='tokenc'>
            </tbody>
          </table>

      </div>
</div>
