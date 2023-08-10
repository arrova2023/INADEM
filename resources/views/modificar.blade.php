<h1>0.- Tecnología/Proyecto</h1>
<br>
<h4>*<i>Haga doble click encima de un campo para editarlo.</i></h4>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                
                <tbody>
                  <tr>
                    <span id="idProyecto" class="hidden">{{ $proyecto[0]->idProyecto}}</span>
                     <div class="form-group col-md-12">
                        <label for="titulo" ><strong>Título:</strong></label>
                         <textarea style="resize: vertical" class="form-control col-md-6" id="tituloProy" rows="2">{{ $proyecto[0]->titulo }}</textarea>
                     </div>
                     <div class="form-group col-md-12">
                         <label for="tituloComercial"><Strong>Título comercial:</Strong></label>
                         <textarea style="resize: vertical" class="form-control" id="tituloComercial" rows="2">{{ $proyecto[0]->tituloComercial}}</textarea>
                     </div>
                 </tr>
                 <tr>
                     <div class="form-group col-md-12">
                            <label for="problematica"><strong>Problemática a resolver:</strong></label>
                            <textarea style="resize: vertical" class="form-control" id="problematica" rows="6">{{ $proyecto[0]->problematica}}</textarea>
                        </div>
                
                        <div class="form-group col-md-12">
                            <label for="descripcion"><strong>Descripción / resumen:</strong></label>
                            <textarea style="resize: vertical" class="form-control" id="descripcion" rows="6">{{ $proyecto[0]->descripcion}}</textarea>
                        </div>
                        </tr>

                        <tr>
                        <div class="form-group col-md-6">
                            <label for="name"><strong>Institución:</strong></label>
                            <select id="institucion" required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-green" name="instEq">
                            <option value="-1">Seleccione una opción</option>
                            @foreach ($instituciones as $institucion)
                            <option value="{{$institucion->idInstitucion}}" {{$institucion->idInstitucion==$proyecto[0]->fk_idInstitucion? 'selected="selected"': '' }}> {{ $institucion->nombreInstitucion }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name"><strong>Tipo de invención:</strong></label>
                            <select required id="tipoInvencion" class="form-control selectpicker" data-style="btn-green" name="tipoInv">
                                <option>Seleccione una opción</option>
                                @foreach ($invenciones as $invencion)
                                <option value="{{$invencion->idTipoInvencion}}" {{$invencion->idTipoInvencion==$proyecto[0]->fk_idTipoInvencion? 'selected="selected"': '' }}> {{ $invencion->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </tr>
                </tbody>
            </table>
         
<h1>1-. Equipo emprendedor/Inventor</h1>
            <table id="datosEmprendedor" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Último grado de estudios</th>
                        <th>Área de Conocimiento</th>
                        <th>Correo Electrónico</th>
                        <th>Número Celular</th>
                        <th>Institución</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participantes as $participante)
                    <tr class="item">
                     
                        <td><input id="nombrePart" type="text" value="{{ $participante->nombre }}"/></td>
                        <td> 
                            <select id="gradoestudios" required class="form-control selectpicker" data-style="btn-green" name="Grado">
                                <option>Seleccione una opción</option>
                                @if($participantes == null)
                                @foreach ($gradosestudios as $gradoestudio)
                                <option value="{{$gradoestudio->idGradoEstudios}}">{{ $gradoestudio->nivel }}</option>
                                @endforeach
                                @else
                                @foreach ($gradosestudios as $gradoestudio)
                                <option value="{{$gradoestudio->idGradoEstudios}}" {{ $gradoestudio->idGradoEstudios==$participante->fk_idGradoEstudios? 'selected="selected"': '' }}>{{ $gradoestudio->nivel }}</option>
                                @endforeach
                                @endif
                            </select>
                        </td>

                        <td>
                            <select id="areaCon" required class="form-control selectpicker" data-style="btn-green" name="area">
                                @foreach ($areasconocimiento as $areaconocimiento)
                                <option value="{{$areaconocimiento->idAreaConocimiento}}" {{ $areaconocimiento->idAreaConocimiento==$participante->fk_idAreaConocimientos? 'selected="selected"': '' }}>{{ $areaconocimiento->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input class="form-control" type="text" id="correo" value="{{ $participante->correoElectronico }}" /></td>
                        <td><input class="form-control" type="text" id="numeroMovil" value="{{ $participante->numeroMovil }}" /></td>
                        <td>
                            <select id="institucion" required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-green" name="instEq">
                                <option>Seleccione una opción</option>
                                @foreach ($instituciones as $institucion)
                                <option value="{{$institucion->idInstitucion}}" {{$institucion->idInstitucion==$participante->fk_idInstitucion? 'selected="selected"': '' }}> {{ $institucion->nombreInstitucion }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>

<h1>2.- Descripción del Proyecto</h1>
            <table id="datosDescripcion" class="table table-hover table-condensed" style="width:100%">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        
                            <div class="form-group col-md-4">
                            <label for="problematica"><strong>Estado de Desarollo/Madurez (TLR):</strong></label>
                            <select id="trl" required class="form-control selectpicker" data-style="btn-green" name="trl">
                                @foreach ($trls as $trl)
                                <option value="{{$trl->idTRL}}" {{ $trl->idTRL==$proyecto[0]->fk_idTRL? 'selected="selected"': '' }}> {{ $trl->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                            <div class="form-group col-md-4">
                            <label for="problematica"><strong>Sector estratégico:</strong></label>
                            <select id="sector" required class="form-control selectpicker" data-style="btn-green" name="sector">
                                <option>Seleccione una opción</option>
                                @foreach ($sectores as $sector)
                                <option value="{{$sector->idSector}}" {{$sector->idSector==$proyecto[0]->fk_idSector? 'selected="selected"': '' }}> {{ $sector->descripcion }}</option>
                                @endforeach                         
                            </select>
                        </div>                            
                        
                        
                            <div class="form-group col-md-4">
                            <label for="problematica"><strong>Propiedad intelectual:</strong></label>
                            <select  id="propiedadInt" required class="form-control selectpicker" data-style="btn-green" name="propInt">
                            @foreach ($propiedadIntelectual as $propiedadintelectual)
                                <option value="{{$propiedadintelectual->idTipoPropiedadIntelectual}}" {{ $propiedadintelectual->idPropiedadIntelectual==$proyecto[0]->fk_idPropiedadIntelectual? 'selected="selected"': '' }}>{{ $propiedadintelectual->descripcion }}</option>
                            @endforeach
                            </select>
                        </div>
                        </tr>
                        <tr>
                            <div class="form-group col-md-4">
                            <label for="problematica"><strong>Lo que persigue el Proyecto/Tecnología:</strong></label>
                            <select id="objProy" required class="form-control selectpicker" data-style="btn-green" name="objPro">
                                @foreach ($objetivosProyecto as $tipoobjetivoproyecto)
                                <option value="{{$tipoobjetivoproyecto->idtipoObjetivoProyecto}}" {{ $tipoobjetivoproyecto->idtipoObjetivoProyecto==$proyecto[0]->fk_idObjetivoProyecto? 'selected="selected"': '' }}>{{ $tipoobjetivoproyecto->descripcion }}</option>
                                 @endforeach
                            </select>
                        </div>
                        
                        
                            <div class="form-group col-md-4">
                            <label for="problematica"><strong>Tipo de protección <i>(Sólo si aplica):</strong></label>
                            <select id="tipoProteccion" required class="form-control selectpicker" data-style="btn-green" name="tipoProteccion">
                                <option>Seleccione una opción</option>
                                @foreach ($tiposProteccion as $tipoproteccion)
                                <option value="{{$tipoproteccion->idTipoProteccion}}" {{ $tipoproteccion->idTipoProteccion==$propiedadintelectual->fk_idTipoProteccion? 'selected="selected"': '' }}>{{ $tipoproteccion->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </tr>
                </tbody>
            </table>

            <table id="datosAnalisis" class="table table-hover table-condensed" style="width:100%">
                
                <tbody>
                    <tr>
                        <div class="form-group col-md-12">
                        <label for="titulo" ><strong>Usos/Aplicaciones</strong></label>
                        <textarea style="resize: vertical" class="form-control col-md-6" id="usoAplicacion" rows="6">{{ $analisisentorno[0]->usoAplicacion }}</textarea>
                    </div>
                    </tr>
                    <tr>
                        <div class="form-group col-md-12">
                        <label for="titulo" ><strong>Vabilidad</strong></label>
                        <textarea style="resize: vertical" class="form-control col-md-6" id="viabilidad" rows="6">{{ $analisisentorno[0]->viabilidad }}</textarea>
                    </div>
                    </tr>
                    <tr>
                        <div class="form-group col-md-12">
                        <label for="titulo" ><strong>Beneficios</strong></label>
                        <textarea style="resize: vertical" class="form-control col-md-6" id="beneficios" rows="6">{{ $analisisentorno[0]->beneficios }}</textarea>
                    </div>
                    </tr>
                </tbody>
            </table>

<h1>3.- Colaboración con otras IES</h1>
<div class="form-group col-md-12">
<textarea style="resize: vertical" class="form-control" rows="6" placeholder="Colaboración con otras IES
" title="Descripción IES y tipo de colaboración" name="desIES" id="desIES" required="">{{ $colaboracion[0]->descripcion}}</textarea>
</div>

<h1>4.- Riesgos</h1>
<div class="form-group col-md-12">
            <table id="datosRiesgos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Tipo de Riesgo</th>
                        <th>Descripción</th>
                        <th>Estrategia de mitigación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riesgos as $riesgo)
                        <tr class="item">
                            <td>
                            <select id="tipoRiesgo" required class="form-control selectpicker" data-style="btn-green" name="tipoRiesgos">
                                @foreach ($tiporiesgos as $tiporiesgo)
                                <option value="{{$tiporiesgo->idTipoRiesgo}}"  {{ $tiporiesgo->idTipoRiesgo==$riesgo->fk_idTipoRiesgo? 'selected="selected"': '' }}> {{ $tiporiesgo->descripcion }}</option>
                                @endforeach
                            </select>
                            </td>

                        <td><textarea style="resize: vertical" class="form-control col-md-6" id="descripcionRiesgo" rows="2">{{ $riesgo->descripcionRiesgo}}</textarea></td>
                        <td><textarea style="resize: vertical" class="form-control col-md-6" id="estrategiaMitigacion" rows="2">{{ $riesgo->estrategiaMitigacion}}</textarea></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            
<h1>5.- Análisis del Entorno</h1>
<tr>
<div class="form-group col-md-12">
<textarea style="resize: vertical" class="form-control col-md-6"  placeholder="Análisis del entorno
" title="Descripción IES y tipo de colaboración" name="desIES" required="" id="analisisEntorno" rows="6">
    {{ $analisisentorno[0]->descripcionAnalisisEntorno}}
</textarea>
</div>
</tr>

<h1>6.- Recursos</h1>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <tbody>
                    <tr>
                        <div class="form-group col-md-12">
                        <label for="titulo" ><strong>Humanos</strong></label>
                        <textarea style="resize: vertical" class="form-control col-md-6" id="recursosHumanos" rows="6">{{ $analisisentorno[0]->recursosHumanos}}</textarea>
                    </div>
                    </tr>
                    <tr>
                        <div class="form-group col-md-12">
                        <label for="titulo" ><strong>Tecnológicos</strong></label>
                        <textarea style="resize: vertical" class="form-control col-md-6" id="recursosTecnologicos" rows="6">{{ $analisisentorno[0]->recursosTecnologicos}}</textarea>
                    </div>
                        </tr>
                        <tr>
                            <div class="form-group col-md-12">
                            <label for="titulo" ><strong>Financieros</strong></label>
                        <textarea style="resize: vertical" class="form-control col-md-6" id="recursosFinancieros" rows="6">{{ $analisisentorno[0]->recursosFinancieros}}</textarea>
                    </div>
                    </tr>
                </tbody>
            </table>
 <div align="center">
        <button type="button" class="btn btn-primary"  onclick="guardarCambios();">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='../admin'">Volver</button>
        <br>
        <br>
    </div>
