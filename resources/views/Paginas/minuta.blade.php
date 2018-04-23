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
<!-- JQuery Nestable Css -->
<link href="{{asset('/plugins/nestable/jquery-nestable.css')}}" rel="stylesheet" />
@stop

@section('cabecera')
Nueva Minuta
@stop


@section('contenido')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="info-box fondo  hover-zoom-effect" id="paso1">
                      <div class="icon hidden-xs">
                          <i class="material-icons">event</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Detalles de la reunión</div>
                          <div class="number">1</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                  <div class="info-box fondo  hover-zoom-effect" id="paso2">
                      <div class="icon hidden-xs">
                          <i class="material-icons">contacts</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Asistencia</div>
                          <div class="number">2</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="info-box fondo  hover-zoom-effect" id="paso3">
                      <div class="icon hidden-xs">
                          <i class="material-icons">assignment</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Temas tratados y pendientes</div>
                          <div class="number">3</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                  <div class="info-box fondo  hover-zoom-effect" id="paso4">
                      <div class="icon hidden-xs">
                          <i class="material-icons">subject</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Compromisos</div>
                          <div class="number">4</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                  <div class="info-box fondo  hover-zoom-effect" id="paso5">
                      <div class="icon hidden-xs">
                          <i class="material-icons">subject</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Resumen</div>
                          <div class="number">5</div>
                      </div>
                  </div>
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
                                    <th style="width: 400px !important">Asistencia</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th style="width: 400px !important">Asistencia</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($minuta->reunion->convocados as $convocado)
                                @unless($convocado->id_usuario == Auth::user()->id_usuario)
                                  <tr>
                                    <td id="nmd_checkbox_{{$convocado->usuario->id_usuario}}">{{$convocado->usuario->__toString()}}</td>
                                    <td>
                                      <div class="row">
                                        <div class="col-lg-2 col-md-2">
                                          <input type="checkbox" onClick="actualizarLista(this);" id="md_checkbox_{{$convocado->id_usuario}}" class="chk-col-teal" autocomplete="off"/>
                                          <label for="md_checkbox_{{$convocado->id_usuario}}">Agregar</label>
                                        </div>
                                        <div id="amd_checkbox_{{$convocado->id_usuario}}" class="col-lg-10 col-md-10 oculto">

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
                              @foreach($minuta->reunion->orden_dia as $orden)
                                <tr>
                                    <th scope="row">{{$orden->descripcion}}</th>
                                    <td id="dh_{{$orden->id_orden_dia}}" onclick="mostrarDh(this)">Ingrese la descripcion de lo hechos</td>
                                    <td><input type="checkbox" onClick="actualizarLista(this);" id="md_checkbox_{{$orden->id_orden_dia}}" class="chk-col-teal" autocomplete="off"/>
                                    <label for="md_checkbox_{{$orden->id_orden_dia}}">Agregar</label></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>

                  <div id="menu4" class="oculto">
                    <h4>Compromisos</h4>
                    <hr/>
                    <div class="dd">
                        <ol class="dd-list">
                          @foreach($minuta->reunion->orden_dia as $orden)
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle">{{$orden->descripcion}}</div>
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">Responsable: {{$orden->usuario->__toString()}}</div>
                                    </li>
                                </ol>
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">Compromisos</div>
                                    </li>
                                </ol>
                              </li>
                            @endforeach
                            </ol>
                          </div>
                  </div>
                  <div id="menu5" class="oculto">
                    <h4>Resumen final de la minuta</h4>
                    <hr/>
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
                <h4 class="modal-title" id="smallModalLabel">Tema de la reunión</h4>
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
<!-- Jquery Nestable -->
<script src="{{asset('/plugins/nestable/jquery.nestable.js')}}"></script>

<script>
var colorCheck = "chk-col-light-green";
var colorBtn = "btn bg-light-green waves-effect";
var colorBtnDis = "btn btn-default waves-effect";
var fondo = "bg-light-green";
var tema = "theme-light-green";
var colorSpinner = '#8BC34A';

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

<script src="{{asset('/js/paginas/minuta.js')}}"></script>

@stop
