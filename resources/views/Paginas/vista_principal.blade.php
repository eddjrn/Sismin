@extends('Layout.layout')

@section('titulo')
Página principal
@stop

@section('estilos')
<!-- Bootstrap Select Css -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@stop

@section('cabecera')
Página Principal
@stop

@section('contenido')
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">assignment_turned_in</i>
            </div>
            <div class="content">
                <div class="text">Compromisos</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">description</i>
            </div>
            <div class="content">
                <div class="text">Nuevas minutas</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">today</i>
            </div>
            <div class="content">
                <div class="text">Próximas reuniones</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">format_list_numbered</i>
            </div>
            <div class="content">
                <div class="text">Temas pendientes</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

<!-- Basic Card -->
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    Mis reuniones <small>Soy moderador de tres reuniones </small>
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Motivo</th>
                            <th>Moderador</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td><button class="btn bg-pink waves-effect" type="submit">Mostrar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>

  <div class="row clearfix">
      <div class="col-lg-12">
          <div class="card">
              <div class="header">
                  <h2>
                      Reunion selecionada <small>Moderador: Mayra Villavicencio</small>
                  </h2>
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-4">
                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <a href="../../images/image-gallery/1.jpg" data-sub-html="Demo Description">
                                    <img class="img-responsive thumbnail" src="../../images/image-gallery/thumb/thumb-1.jpg">
                                </a>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-lg-12">
                            <h3>Motivo de la minuta</h3>
                            Moderador: Mayra Villavicencio.<br>
                            Secretario: Eduardo Javier Reyes.<br>
                            Numero de reunion: 3.<br>
                            Motivo: Precio del próximo evento.<br>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <button class="btn bg-pink waves-effect" type="submit">Realizar minuta</button>
                          </div>
                          <div class="col-lg-6">
                            <button type="button" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#responsabilidadModal">Delegar responsabilidad</button>
                         </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <!-- Striped Rows -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Convocados
                                        <small>5</small>
                                    </h2>
                                </div>
                                <div class="body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Correo electrónico</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>@mdo</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Striped Rows -->
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="responsabilidadModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="largeModalLabel">Delegar responsabilidad de secretario</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <select class="form-control show-tick">
                                    <option value="">-- Seleccionar --</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                      </div>
                      </div>
                    </div>
                    <div class="modal-footer row clearfix">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" id="clear" data-dismiss="modal" class="btn bg-pink btn-block waves-effect">Cancelar</button>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Guardar</button>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>

@stop

@section('scripts')
<!-- Select Plugin Js -->
<script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
@stop
