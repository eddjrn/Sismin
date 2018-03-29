@extends('Layout.layout')

@section('titulo')
Nueva reunión
@stop

@section('estilos')
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
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="info-box fondo  hover-zoom-effect">
                      <div class="icon hidden-xs">
                          <i class="material-icons">event</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Alta de reunión</div>
                          <div class="number">1</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="info-box fondo  hover-zoom-effect">
                      <div class="icon hidden-xs">
                          <i class="material-icons">contacts</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Convocados</div>
                          <div class="number">2</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="info-box fondo  hover-zoom-effect">
                      <div class="icon hidden-xs">
                          <i class="material-icons">assignment</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Orden del día</div>
                          <div class="number">3</div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="info-box fondo  hover-zoom-effect">
                      <div class="icon hidden-xs">
                          <i class="material-icons">subject</i>
                      </div>
                      <div class="content">
                          <div class="text hidden-sm hidden-xs">Resumen</div>
                          <div class="number">4</div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="container-fluid">
                  <div id="menu1">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-lg-offset-1 col-md-offset-1">
                          <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="datetimepicker form-control" name="fecha">
                                <label class="form-label">Fecha y hora</label>
                            </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" class="form-control" name="motivo">
                                  <label class="form-label">Motivo de la reunión</label>
                              </div>
                          </div>
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" class="form-control" name="lugar">
                                  <label class="form-label">Lugar de la reunión</label>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-lg-offset-2 col-md-offset-2">
                          <p class="col-grey">Tipo de reunión</p>
                          <select class="form-control show-tick" data-live-search="true">
                              <option>Seleccionar</option>
                              <option>Burger, Shake and a Smile</option>
                          </select>
                          <br/>
                          <br/>
                          <img class="img-responsive thumbnail" src="{{asset('/images/iconoFull.svg')}}" width="150" height="150" style="margin: auto;">
                        </div>
                    </div>
                  </div>
                  <div id="menu2" class="oculto">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Rol dentro de la reunión</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo electrónico</th>
                                    <th>Rol dentro de la reunión</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>
                                      <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                          <input type="checkbox" id="md_checkbox_1" class="chk-col-teal" checked />
                                          <label for="md_checkbox_1">Agregar</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9">
                                          <select class="form-control show-tick">
                                              <option>Seleccionar</option>
                                              <option>Burger, Shake and a Smile</option>
                                          </select>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div id="menu3" class="oculto">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 text-center">
                        <h4>Temas pendientes</h4>
                        <div class="well" style="height: 200px; overflow-y: scroll;">
                          <div class="list-group">
                              <button type="button" class="list-group-item" style="word-wrap: break-word;">
                                gdfgdfg
                              </button>
                          </div>
                        </div>
                        <button type="button" class="colorBoton">Agregar a la lista</button>
                      </div>
                      <div class="col-lg-6 col-md-6 text-center">
                        <h4>Orden del día</h4>
                        <div class="well" style="height: 200px; overflow-y: scroll;">
                          <div class="list-group">
                              <button type="button" class="list-group-item" style="word-wrap: break-word;" data-toggle="modal" data-target="#temasModal">
                                gdfgdfg
                              </button>
                          </div>
                        </div>
                        <button type="button" class="colorBoton" data-toggle="modal" data-target="#temasModal">Nuevo tema</button>
                      </div>
                    </div>
                  </div>
                  <div id="menu4" class="oculto">
                    <div class="well">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          {{now()}}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <img class="img-responsive thumbnail" src="{{asset('/images/iconoFull.svg')}}" style="float: right !important;" width="150" height="150">
                        </div>
                      </div>

                      <h2 class="align-center">Junta de consejo</h2>
                      <h4>Motivo: Presentacion de junta de consejo</h4>

                      <h5>Convocados</h5>
                      <ul>
                        <li>- Eduardo Javier Reyes Norman</li>
                        <li>- Mayra Villavicencio Marquez</li>
                      </ul>

                      <h5>Para tratar los siguientes temas</h5>
                      <ol>
                        <li>Pase de lista</li>
                        <li>Dudas y preguntas</li>
                        <li>Conclusiones</li>
                      </ol>

                      <br/>
                      Fecha de: {{now()}}
                      <br/>
                      <br/>
                      Lugar: CDV

                      <h3 class="align-center">Atte: Eduardo (Moderador)</h3>
                    </div>
                  </div>
                </div>
              </div>
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
                      <i class="material-icons">assignment</i>
                  </span>
                  <div class="form-line">
                      <input class="form-control date" placeholder="Descripción" type="text">
                  </div>
              </div>
              <p class="col-grey">Responsable</p>
              <select class="form-control show-tick" data-live-search="true">
                  <option>Seleccionar</option>
                  <option>Burger, Shake and a Smile</option>
              </select>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-lg-6 col-md-6 text-center">
                  <button type="button" class="colorBoton btn-block">Guardar</button>
                </div>
                <div class="col-lg-6 col-md-6 text-center">
                  <button type="button" class="colorBoton btn-block" data-dismiss="modal">Cancelar</button>
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
<script src="{{asset('/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

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

var urlToCancelPage = "{{asset('/')}}";
</script>

<script src="{{asset('/js/paginas/reunion.js')}}"></script>

@stop
