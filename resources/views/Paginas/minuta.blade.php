@extends('Layout.layout')

@section('titulo')
Nueva minuta
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{asset('/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

<!-- Wait Me Css -->
<link href="{{asset('/plugins/waitme/waitMe.css')}}" rel="stylesheet" />

<!-- Bootstrap Select Css -->
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

<link href="{{asset('/css/treeview/easyTree.css')}}" rel="stylesheet" />
@stop

@section('cabecera')
Nueva Minuta
@stop


@section('contenido')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
              <?php
                $tamanioPasos = "col-lg-2 col-md-2 col-sm-2 col-xs-4";
              ?>
              <div class="row text-center">
                <div class="{{$tamanioPasos}} col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-2">
                  <button type="button" id="paso1" class="btn bg-pink btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Detalles de la reunión">
                    <i class="material-icons">library_books</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso2" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Asistencia">
                    <i class="material-icons">contacts</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso3" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Temas tratados y pendientes">
                    <i class="material-icons">assignment_turned_in</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso4" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Compromisos">
                    <i class="material-icons">list</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso5" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Resumen final de la minuta">
                    <i class="material-icons">subject</i>
                  </button>
                </div>
              </div>

              <div class="row">
                <div class="container-fluid">
                  <div id="menu1">
                    <h4>Detalles de la reunión</h4>
                    <hr/>
                    <div style="height:500px">
                      <?php
                      $url= "/pdf/".$minuta->reunion->id_reunion."/".$minuta->reunion->codigo;
                      ?>
                        <object data="{{asset($url)}}" type="application/pdf" width="100%" height="100%"></object>
                    </div>
                  </div>
                  <div id="menu2" class="oculto">
                    <h4>Asistencia</h4>
                    <hr/>
                    <div class="table-responsive bar" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Rol dentro de la reunión</th>
                                    <th style="width: 400px !important">Asistencia</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Rol dentro de la reunión</th>
                                    <th style="width: 300px !important">Asistencia</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                  $indice_asistencia = 0;
                                ?>
                                @foreach($minuta->reunion->convocados as $convocado)
                                @unless($convocado->id_usuario == Auth::user()->id_usuario)
                                <?php
                                  $indice_asistencia++;
                                ?>
                                  <tr>
                                    <td id="nmd_checkbox_{{$convocado->usuario->id_usuario}}">{{$convocado->usuario->__toString()}}</td>
                                    <td>{{$convocado->rol->descripcion}}</td>
                                    <td>
                                      <div class="row">
                                        <div class="col-lg-12" data-asistencia="{{$indice_asistencia}}">
                                          <input type="checkbox" onClick="actualizarAsistencia(this);" id="asistencia_checkbox_{{$convocado->id_convocado}}" class="chk-col-teal" autocomplete="off"/>
                                          <label for="asistencia_checkbox_{{$convocado->id_convocado}}">Agregar asistencia</label>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                @endunless
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="menu3" class="oculto">
                    <h4>Temas tratados y pendientes</h4>
                    <hr/>
                    <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tema</th>
                                    <th>Descripción de los hechos</th>
                                    <th>Tema pendiente</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                $indice_pendientes = 0;
                              ?>
                              @foreach($minuta->reunion->orden_dia as $orden)
                                <tr>
                                    <th scope="row">{{$orden->descripcion}}</th>
                                    <td id="dh_{{$orden->id_orden_dia}}" onclick="mostrarDialogoHechos(3, this);" data-pendiente="{{$indice_pendientes}}">Ingrese la descripcion de lo hechos.</td>
                                    <td width="200px">
                                      <input type="checkbox" onClick="actualizarPendientes(this);" data-pendiente="{{$indice_pendientes}}" id="pendiente_checkbox_{{$orden->id_orden_dia}}" class="chk-col-teal" autocomplete="off"/>
                                      <label for="pendiente_checkbox_{{$orden->id_orden_dia}}">Agregar como pendiente</label>
                                    </td>
                                </tr>
                              <?php
                                $indice_pendientes++;
                              ?>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>

                  <div id="menu4" class="oculto">
                    <h4>Compromisos</h4>
                    <hr/>
                    <ul class="treeview">
                        @foreach($minuta->reunion->orden_dia as $orden)
                        <li><a class="col-white label fondo">Tema:</a><span> {{$orden->descripcion}}</span>
                        	<ul>
                            <li><i class='tree-indicator glyphicon glyphicon-user'></i><span>Responsable del tema: {{$orden->usuario->__toString()}}</span></li>
                            <li><a href="#">Compromisos</a>
                            	<ul id="compromisoLista_{{$orden->id_orden_dia}}">
                                <li><a onClick="actualizarCompromiso(4, {{$orden->id_orden_dia}});" class="font-bold texto"><i class='tree-indicator glyphicon glyphicon-plus'></i>Agregar nuevo compromiso</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                  <div id="menu5" class="oculto">
                    <h4>Resumen final de la minuta</h4>
                    <hr/>
                    <div class="well bar" style="height: 300px; overflow-y: scroll;">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-6 col-md-offset-6 col-xs-offset-6">
                          <img class="thumbnail" src="{{$minuta->reunion->tipo_reunion->imagen_logo}}" style="float: right !important;" width="150" height="150">
                        </div>
                      </div>
                      <h2 id="tipo_texto" class="align-center">"{{$minuta->reunion->tipo_reunion->descripcion}}"</h2>
                      <hr/>
                      <h4>Fecha: <span id="fecha_hoy"></span></h4>
                      <h4>Lugar: {{$minuta->reunion->lugar}}</h4>
                      <h4>Motivo: {{$minuta->reunion->motivo}}</h4>
                      <h4>Reunión convocada por: {{$minuta->reunion->moderador()->__toString()}}</h4>
                      <hr/>
                      <h3>Participantes</h3>
                      <hr/>
                      <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Rol dentro de la reunión</th>
                              <th>Asistencia</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($minuta->reunion->convocados as $convocado)
                            <tr>
                              <td id="convocado_resumen_nombre_{{$convocado->id_convocado}}">{{$convocado->usuario->__toString()}}</td>
                              <td>{{$convocado->rol->descripcion}}</td>
                              <td id="resumen_convocado_asistencia_{{$convocado->id_convocado}}">
                                @if($convocado->id_usuario == Auth::user()->id_usuario)
                                Presente
                                @else
                                Ausente
                                @endif
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                      <h3>Temas tratados / descripción de los hechos</h3>
                      <hr/>
                      <ol>
                        <?php
                          $indice = 0;
                        ?>
                        @foreach($minuta->reunion->orden_dia as $orden)
                        <?php
                          $indice++;
                        ?>
                        <li><span id="descripcion_orden_resumen_{{$orden->id_orden_dia}}" data-numero="{{$indice}}">{{$orden->descripcion}}</span> <span id="orden_pendiente_resumen_{{$orden->id_orden_dia}}"></span>
                          <ul>
                            <li id="descripcion_hechos_resumen_dh_{{$orden->id_orden_dia}}">Ingrese la descripcion de lo hechos.</li>
                          </ul>
                        </li>
                        @endforeach
                      </ol>
                      <h3>Compromisos asumidos</h3>
                      <hr/>
                      <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Tema</th>
                              <th>compromiso</th>
                              <th>Responsable(s)</th>
                              <th>Fecha limite</th>
                            </tr>
                          </thead>
                          <tbody id="tabla_compromisos_resumen"></tbody>
                      </table>
                      <hr/>
                      <h3>Notas de la minuta</h3>
                      <div class="input-group">
                          <div class="form-line">
                            <textarea id="notas_minuta" rows="6" class="form-control no-resize" placeholder="Notas."></textarea>
                          </div>
                      </div>
                      <hr/>
                      <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>Firma</th>
                            </tr>
                          </thead>
                          <tbody id="firmas_resumen">
                            <tr>
                              <td id="firmas_resumen_convocado_g">{{Auth::user()}}</td>
                              <td>
                                <button id="usuario_g" type="button" onClick="firmarMinuta(1, this);" class="colorBoton">Firmar</button>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <hr/>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                  <button type="button" id="anterior" class="colorBotonDis" onClick="anterior()">Anterior</button>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                  <button type="button" id="siguiente" class="colorBoton" onClick="siguiente()">Siguiente</button>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                  <button type="button" class="colorBoton" onClick="cancelar()">Cancelar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="compromisoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="compromisoModalTitulo" class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">subject</i>
                  </span>
                  <div class="form-line">
                      <input id="descripcion_nuevo_compromiso" class="form-control date" placeholder="Descripción" type="text">
                  </div>
              </div>
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">event</i>
                  </span>
                  <div class="form-line">
                      <input placeholder="Fecha y hora" type="text" data-fecha="" data-fechaLegible="" class="datetimepicker form-control" id="fecha" name="fecha" autocomplete="off">
                  </div>
              </div>
              <p class="col-grey">Responsable</p>
              <select id="responsable_nuevo_compromiso" class="form-control show-tick" data-live-search="true" autocomplete="off">
                  <option value="0">Seleccionar</option>
                  @foreach($minuta->reunion->convocados as $convocado)
                    <option value="{{$convocado->usuario->id_usuario}}">{{$convocado->usuario->__toString()}}</option>
                  @endforeach
              </select>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                  <button type="button" class="colorBoton btn-block" onClick="limpiarDialogo();">Cancelar</button>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                  <button id="btnGuardar" type="button" onClick="" class="colorBoton btn-block">Guardar</button>
                </div>
              </div>
              <div id="filaEliminar" class="row oculto">
                <br/>
                <div class="col-lg-12 col-md-12 text-center">
                  <button id="btnEliminar" type="button" onClick="" class="btn btn-danger waves-effect btn-block">Eliminar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hechosModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="hechosModalTitulo" class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">subject</i>
                  </span>
                  <div class="form-line">
                      <textarea id="hechosDescripcion" rows="4" class="form-control no-resize" placeholder="Descripción de los hechos."></textarea>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                  <button type="button" class="colorBoton btn-block" onClick="ocultarHechosDialogo();">Cancelar</button>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                  <button id="btnGuardarhechos" type="button" onClick="" class="colorBoton btn-block">Guardar</button>
                </div>
              </div>
              <div id="filaEliminarHechos" class="row oculto">
                <br/>
                <div class="col-lg-12 col-md-12 text-center">
                  <button id="btnEliminarHechos" type="button" onClick="" class="btn btn-danger waves-effect btn-block">Eliminar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="firmaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar firma de: <span id="firmaModalTitulo"></span></h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">vpn_key</i>
                  </span>
                  <div class="form-line">
                      <input id="clave_firma" class="form-control" placeholder="Contraseña del convocado." type="password">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                  <button type="button" class="colorBoton btn-block" onClick="firmarMinuta(2);">Cancelar</button>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                  <button id="btnFirmarMinuta" type="button" onClick="" class="colorBoton btn-block">Firmar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<!-- Jquery Validation Plugin Css -->
<script src="{{asset('/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('/plugins/jquery-validation/localization/messages_es.js')}}"></script>

<!-- Autosize Plugin Js -->
<script src="{{asset('/plugins/autosize/autosize.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Multi Select Plugin Js -->
<script src="{{asset('/plugins/multi-select/js/jquery.multi-select.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{asset('/plugins/momentjs/moment.js')}}"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{asset('/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<script src="{{asset('/js/treeview/easyTree.js')}}"></script>

<script>
var colorCheck = "chk-col-light-green";
var colorBtn = "btn bg-light-green waves-effect";
var colorBtnDis = "btn btn-default waves-effect";
var fondo = "bg-light-green";
var tema = "theme-light-green";
var colorSpinner = '#8BC34A';
var textoColor = "col-light-green";




var moderador = "{{Auth::user()->id_usuario}}";

var url = "{{asset('/minuta')}}";
var urlToCancelPage = "{{asset('/')}}";
var urlToRedirectPage = "{{asset('/')}}";
var urlEnterado = "{{asset('/minuta/enterado')}}";

var convocados_constante = {{$indice_asistencia}};
var pendientes_constante = {{$indice_pendientes}};
var descripcionHechos_constante = {{$indice_pendientes}};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script src="{{asset('/js/paginas/minuta.js')}}"></script>

@stop
