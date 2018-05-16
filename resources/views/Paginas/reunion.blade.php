@extends('Layout.layout')

@section('titulo')
Nueva reunión
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

@stop

@section('cabecera')
Nueva reunión
@stop

@section('contenido')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
              <?php
                $tamanioPasos = "col-lg-3 col-md-3 col-sm-3 col-xs-3";
              ?>
              <div class="row text-center">
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso1" class="btn bg-pink btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Dar de alta una reunión">
                    <i class="material-icons">event</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso2" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Agregar los convocados de la reunión">
                    <i class="material-icons">contacts</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso3" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Crear la orden del día de la reunión">
                    <i class="material-icons">assignment</i>
                  </button>
                </div>
                <div class="{{$tamanioPasos}}">
                  <button type="button" id="paso4" class="btn fondo btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Resumen final de la reunión">
                    <i class="material-icons">subject</i>
                  </button>
                </div>
              </div>

              <div class="row">
                <div class="container-fluid">
                  <div id="menu1">
                    <h4>Dar de alta una reunión</h4>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-lg-offset-1 col-md-offset-1">
                          <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" onfocusout="actualizarFecha(this);" data-fecha="" class="datetimepicker form-control" id="fecha" name="fecha" autocomplete="off">
                                <label class="form-label">Fecha y hora</label>
                            </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" onfocusout="actualizarMotivo(this);" class="form-control" id="motivo" name="motivo" autocomplete="off">
                                  <label class="form-label">Motivo de la reunión</label>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" onfocusout="actualizarLugar(this);" class="form-control" id="lugar" name="lugar" autocomplete="off">
                                  <label class="form-label">Lugar de la reunión</label>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-lg-offset-2 col-md-offset-2">
                          <p class="col-grey">Grupo de la reunión</p>
                          <select id="tipo_reunion" onChange="actualizarTipo(this);" class="form-control show-tick" data-container="body" data-live-search="true" autocomplete="off">
                              <option value="0">Seleccionar</option>
                              @foreach($tipos as $tipo)
                              <option value="{{$tipo->id_tipo_reunion}}" data-imagen="{{$tipo->imagen_logo}}">{{$tipo->descripcion}}</option>
                              @endforeach
                          </select>
                          <br/>
                          <br/>
                          <img id="imagen_tipo_reunion" class="img-responsive thumbnail" src="{{asset('/images/imagen.svg')}}" width="150" height="150" style="margin: auto;">
                        </div>
                    </div>
                  </div>
                  <div id="menu2" class="oculto">
                    <h4>Agregar los convocados de la reunión</h4>
                    <hr/>
                    <div class="table-responsive bar" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th style="width: 400px !important">Puesto dentro de la reunión</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th style="width: 400px !important">Puesto dentro de la reunión</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($convocados as $convocado)
                                @unless($convocado->id_usuario == Auth::user()->id_usuario)
                                  <tr>
                                    <td id="nmd_checkbox_{{$convocado->id_usuario}}">{{$convocado->__toString()}}</td>
                                    <td>
                                      <div class="row">
                                        <div class="col-lg-2 col-md-2">
                                          <input type="checkbox" onClick="actualizarLista(this);" id="md_checkbox_{{$convocado->id_usuario}}" class="chk-col-teal" autocomplete="off"/>
                                          <label for="md_checkbox_{{$convocado->id_usuario}}">Agregar</label>
                                        </div>
                                        <div id="amd_checkbox_{{$convocado->id_usuario}}" class="col-lg-10 col-md-10 oculto">
                                          <select id="rol_seleccion_{{$convocado->id_usuario}}" onChange="actualizarRol(this);" data-container="body" data-width="300px" data-size="5" class="show-tick rol" autocomplete="off">
                                              <option value="0">Seleccionar puesto</option>
                                              @foreach($roles as $rol)
                                              <option value="{{$rol->id_rol}}" class="control_rol_{{$rol->id_rol}}">{{$rol->descripcion}}</option>
                                              @endforeach
                                          </select>
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
                    <h4>Crear la orden del día de la reunión</h4>
                    <hr/>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 text-center">
                        <h4>Temas pendientes</h4>
                        <div class="well bar" style="height: 250px; overflow-y: scroll;">
                          <div id="lista_pendientes" class="list-group"></div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 text-center">
                        <h4>Orden del día</h4>
                        <div class="well bar" style="height: 250px; overflow-y: scroll;">
                          <div id="lista_orden" class="list-group"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <button type="button" class="colorBoton" onClick="actualizarOrdenDia(4, null);">Nuevo tema para la orden del día</button>
                      </div>
                    </div>
                  </div>
                  <div id="menu4" class="oculto">
                    <h4>Resumen final de la reunión</h4>
                    <hr/>
                    <div class="well bar" style="height: 350px; overflow-y: scroll;">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-6 col-md-offset-6 col-xs-offset-6">
                          <img id="imagen_tipo_reunion_texto" class="thumbnail" src="{{asset('/images/imagen.svg')}}" style="float: right !important;" width="150" height="150">
                        </div>
                      </div>
                      <h2 id="tipo_texto" class="align-center">"SisMin"</h2>
                      <span>Por  medio  de  la  presente,  se  le  convoca  a </span><span id="motivo_texto"></span><span>para  el  día </span><span id="fecha_texto"></span> , en <span id="lugar_texto"></span>.
                      <br/>
                      <h5>Convocados</h5>
                      <ul id="convocados_texto">
                        <li><span id="rol_texto_auth">Secretario</span>: {{Auth::user()}}</li>
                      </ul>
                      <h5>Para tratar los siguientes temas:</h5>
                      <ol id="lista_texto"></ol>
                      <br/>
                      <p id="fecha_hoy" class="align-right">Hoy</p>
                      <br/>
                      <br/>
                      <h5>Atentamente:</h5>
                      <img id="imagen_tipo_reunion_texto" class="thumbnail" src="{{Auth::user()->rubrica}}" style="margin:auto;" width="150" height="150">
                      <hr style="width: 50%"/>
                      <h3 class="align-center">{{Auth::user()}} (Moderador)</h3>
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

<div class="modal fade" id="temasModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Tema para reunión</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">subject</i>
                  </span>
                  <div class="form-line">
                      <input id="descripcion_nuevo_tema" class="form-control date" placeholder="Descripción" type="text">
                  </div>
              </div>
              <p class="col-grey">Responsable</p>
              <select id="responsable_nuevo_tema" class="form-control show-tick" data-live-search="true">
                  <option value="0">Seleccionar</option>
                  <option id="convocado{{Auth::user()->id_usuario}}" value="{{Auth::user()->id_usuario}}">{{Auth::user()}}</option>
              </select>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                  <button type="button" class="colorBoton btn-block" onClick="actualizarOrdenDia(5, null);">Cancelar</button>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                  <button id="btnGuardar" type="button" onClick="actualizarOrdenDia(1, null);" class="colorBoton btn-block">Guardar</button>
                </div>
              </div>
              <div id="filaEliminar" class="row oculto">
                <br/>
                <div class="col-lg-12 col-md-12 text-center">
                  <button id="btnEliminar" type="button" onClick="actualizarOrdenDia(6, null);" class="btn btn-danger waves-effect btn-block">Eliminar</button>
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

<script>
var colorCheck = "chk-col-cyan";
var colorBtn = "btn bg-cyan waves-effect";
var colorBtnDis = "btn btn-default waves-effect";
var fondo = "bg-cyan";
var tema = "theme-cyan";
var colorSpinner = '#00BCD4';

var urlToCancelPage = "{{asset('/')}}";
var url = "{{asset('/reunion')}}";
var urlToRedirectPage = "{{asset('/')}}";
var moderador = "{{Auth::user()->id_usuario}}";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script src="{{asset('/js/paginas/reunion.js')}}"></script>

@stop
