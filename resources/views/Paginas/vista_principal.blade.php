@extends('Layout.layout')

@section('titulo')
Página principal
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Bootstrap Select Css -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@stop

@section('cabecera')
Página Principal
@stop

@section('contenido')
@unless(isset($nuevo))
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
                <div class="text">Reuniones pendientes</div>
                <div class="number count-to" data-from="0" data-to="{{count($reuniones)}}" data-speed="1000" data-fresh-interval="20"></div>
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
                    Mis reuniones <small>Soy moderador de {{Auth::user()->numModerador()}} </small>
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Motivo</th>
                            <th>Moderador</th>
                            <th>Tipo de reunion</th>
                            <th>Fecha límite</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($reuniones as $reunion)
                        <tr>
                            <th scope="row">{{$reunion->id_reunion}}</th>
                            <td>{{$reunion->motivo}}</td>
                            <td>{{$reunion->moderador()}}</td>
                            <td>{{$reunion->tipo_reunion}}</td>
                            <td>{{$reunion->getLimite()}}</td>
                            <td><button class="btn bg-pink waves-effect" type="button" onclick="mostrar({{$reunion->id_reunion}})" >Mostrar</button></td>
                        </tr>
                        @endforeach
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
                      Reunion selecionada <small>Moderador: <span id="moderador"> {{$reuniones[0]->moderador()}}</span></small>
                  </h2>
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="row">
                      <div class="col-lg-4">
                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                              <img class="thumbnail" id="imgReunion" src="{{$reuniones[0]->tipo_reunion->imagen_logo}}" width="150" height="150">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-lg-12">
                            <h3 id="tipo_reunion">{{$reuniones[0]->tipo_reunion}}</h3>
                            Moderador: <span id="moderador2">{{$reuniones[0]->moderador()}}.</span><br>
                            Secretario: <span id="secretario">{{$reuniones[0]->secretario()}}.</span><br>
                            Fecha de la reunion: <span id="fecha_reunion">{{$reuniones[0]->fecha_reunion}}.</span><br>
                            Motivo:<span id="motivo">{{$reuniones[0]->motivo}}.</span><br>
                          </div>
                        </div>
                        <div class="row" id="btns">
                          <div class="col-lg-6">
                            <button class="btn bg-pink waves-effect" type="submit">Realizar minuta</button>
                          </div>
                          <div class="col-lg-6">
                            <button type="button" class="btn bg-pink waves-effect" id="delegarResp"  onclick="delegarResp()">Delegar responsabilidad</button>
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
                                        <small><span id="convocados3">{{count($reuniones[0]->convocados)}}</span></small>
                                    </h2>
                                </div>
                                <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Rol</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listaConvocados">
                                          @foreach($reuniones[0]->convocados as $convocado)
                                            <tr>
                                                <td><span id="convocadoNombre">{{$convocado->usuario->__toString()}}</span></td>
                                                <td><span id="rol">{{$convocado->rol}}</span></td>
                                            </tr>
                                          @endforeach
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
      </div><script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    </div>

    <div class="modal fade" id="responsabilidadModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-sm" role="document" id="rubricaCanvas">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="largeModalLabel">Delegar responsabilidad de secretario de la reunión:<br> <span id="tipoReunion">"{{$reuniones[0]->tipo_reunion}}".</span></h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <select class="form-control show-tick" id="Copc">
                                    <option value="">-- Seleccionar --</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                      </div>
                      </div>
                    </div>
                    <div class="modal-footer row clearfix">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" id="clear" data-dismiss="modal" class="btn bg-pink btn-block waves-effect" onclick="cancelarSecre()">Cancelar</button>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn bg-pink btn-block waves-effect" data-dismiss="modal" id="actualizarSecre" onclick="actualizarSecre()">Guardar</button>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
@endunless
@stop

@section('scripts')
<!-- Select Plugin Js -->
<script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="{{asset('/js/paginas/vista_principal.js')}}"></script>

<!-- Script de envio de formularios mediante ajax -->
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var url = "{{asset('/vista_principal_detalles')}}";
var urlToRedirectPage = "{{asset('/')}}";
</script>




@stop
