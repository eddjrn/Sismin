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
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-zoom-effect" data-trigger="hover" data-container="body" data-toggle="tooltip" data-placement="top" title="Total de reuniones: {{Auth::user()->convocado_en->count()}}">
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
        <div class="info-box bg-pink hover-zoom-effect" data-trigger="hover" data-container="body" data-toggle="tooltip" data-placement="top" title="Total de compromisos: {{Auth::user()->responsables->count()}}">
            <div class="icon">
                <i class="material-icons">assignment_turned_in</i>
            </div>
            <div class="content">
                <div class="text">Compromisos pendientes</div>
                <div class="number count-to" data-from="0" data-to="{{Auth::user()->responsables->count()}}" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-zoom-effect" data-trigger="hover" data-container="body" data-toggle="tooltip" data-placement="top" title="Total de minutas: {{count(Auth::user()->reuniones_historial())}}">
            <div class="icon">
                <i class="material-icons">description</i>
            </div>
            <div class="content">
                <div class="text">Nuevas minutas</div>
                <div class="number count-to" data-from="0" data-to="{{count(Auth::user()->minutas_recientes())}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-zoom-effect" data-trigger="hover" data-container="body" data-toggle="tooltip" data-placement="top" title="Total de temas pendientes: {{Auth::user()->temas_pendientes->count()}}">
            <div class="icon">
                <i class="material-icons">format_list_numbered</i>
            </div>
            <div class="content">
                <div class="text">Temas pendientes</div>
                <div class="number count-to" data-from="0" data-to="{{Auth::user()->temas_pendientes->where('expirado','=','false')->count()}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

<!-- Basic Card -->
<?php
  $CR= Auth::user()->responsables;
  $icono_vacio = true;
?>
@if(count($CR->where('tarea','=', null)) > 0)
<?php $icono_vacio = false; ?>
<div class="row clearfix">
  <div class="col-lg-12">
      <div class="card">
          <div class="header">
              <h2>
                  Mis compromisos
              </h2>
          </div>
          <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Reunión</th>
                          <th>Fecha del compromiso</th>
                          <th>Descripcion del compromiso</th>
                          <th>Tarea</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($CR as $resp)
                    @if($resp->tarea==null)
                    <tr>
                        <td>{{$resp->compromisos->minuta->reunion->tipo_reunion->descripcion}}</td>
                        <td>{{$resp->compromisos->fecha_limite}}</td>
                        <td>{{$resp->compromisos->descripcion}}</td>
                        <td><button class="btn bg-pink waves-effect" type="button"  onclick="asignarT({{$resp->id_compromiso_resp}})" >Agregar Tarea</button></td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endif

<!-- Basic Card -->
@if(count(Auth::user()->reuniones_pendientes()) > 0)
<?php $icono_vacio = false; ?>
<div class="row clearfix">
  <div class="col-lg-12">
      <div class="card">
          <div class="header">
              <h2>
                  Mis reuniones <small>Soy moderador de {{count(Auth::user()->reuniones_moderadas())}} reuniones.</small>
              </h2>
          </div>
          <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
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
                    @if($reunion->minuta->getOriginal()['fecha_elaboracion'] == null)
                    <tr>
                        <th scope="row">{{$reunion->id_reunion}}</th>
                        <td>{{$reunion->motivo}}</td>
                        <td>{{$reunion->moderador()}}</td>
                        <td>{{$reunion->tipo_reunion}}</td>
                        <td>{{$reunion->getLimite()}}</td>
                        <td><button class="btn bg-pink waves-effect" type="button" onclick="mostrar({{$reunion->id_reunion}})" >Mostrar</button></td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
@endif

@if($icono_vacio)
  <img src="{{asset('/images/iconoFull_gris.svg')}}" style="display: block; margin: auto;" width="250" height="250"/>
  <h2 class="align-center col-blue-grey">No tienes pendientes en esta sección</h2>
  <h2 class="align-center col-blue-grey"><i class="material-icons">tag_faces</i></h2>
@endif

<div class="row clearfix" style="display:none;" id="detalles_reunion">
  <div class="col-lg-12">
      <div class="card">
          <div class="header">
              <h2>
                  Reunion selecionada <small>Moderador: <span id="moderador"></span></small>
              </h2>
          </div>
          <div class="body">
            <div class="row">
              <div class="col-lg-7">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                          <img class="thumbnail" id="imgReunion" src="{{asset('/images/imagen.svg')}}" width="150" height="150">
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="row">
                      <div class="col-lg-12">
                        <h3 id="tipo_reunion"></h3>
                        Moderador: <span id="moderador2"></span><br>
                        Secretario: <span id="secretario"></span><br>
                        Fecha de la reunion: <span id="fecha_reunion"></span><br>
                        Motivo:<span id="motivo"></span><br>
                      </div>
                    </div>
                    <div class="row">
                      <div id="btns">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <button class="btn bg-pink waves-effect" type="button" id="realizarMinuta" onclick="realizarMinuta(id,codigoMinuta)">Realizar minuta</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                          <button type="button" class="btn bg-pink waves-effect" id="delegarResp"  onclick="delegarResp()">Delegar responsabilidad</button>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3" id="eliminarReunion">
                        <button type="button" class="btn bg-red waves-effect" onClick="">Eliminar reunión</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <!-- Striped Rows -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header">
                          <h2>
                              Convocados
                              <small>Cantidad: <span id="convocados3"></span></small>
                          </h2>
                        </div>
                        <div class="well bar" style="height: 300px; overflow-y: scroll;">
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Rol</th>
                                  </tr>
                              </thead>
                              <tbody id="listaConvocados">
                                  <tr>
                                      <td><span id="convocadoNombre"></span></td>
                                      <td><span id="rol"></span></td>
                                  </tr>
                              </tbody>
                          </table>
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
                <h4 class="modal-title" id="largeModalLabel">Delegar responsabilidad de secretario de la reunión:<br> <span id="tipoReunion"></span></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <select class="form-control show-tick" id="Copc"></select>
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

<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <img src="{{asset('/images/cambiar_perfil.svg')}}" width="150" height="150"/>
                  </div>
                </div>
                <h4 class="modal-title" id="largeModalLabel">Eliminar reunión</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">lock</i>
                  </span>
                  <div class="form-line">
                      <input type="password" class="form-control" id="claveDel" name="claveDel" placeholder="Ingrese su contraseña actual" ata-toggle="tooltip" data-placement="top" title="Ingrese su contraseña actual">
                  </div>
              </div>
              <div class="modal-footer row clearfix">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button type="button" onclick="" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button id="btnEliminarModal" type="button"  onclick="" class="btn btn-block bg-red waves-effect" data-dismiss="modal">Eliminar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tareaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Asignar Tarea</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">list</i>
                  </span>
                  <div class="form-line">
                      <input type="text" class="form-control" id="tarea" name="tarea" placeholder="Ingrese la descripcion de la tarea" ata-toggle="tooltip" data-placement="top" title="Ingrese la descripcion de la tarea">
                  </div>
              </div>
              <div class="modal-footer row clearfix">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button type="button" onclick="" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button  type="button"  onclick="actualizarTarea()" id="btnAsignarT" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Guardar</button>
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
var urlS = "{{asset('/vista_principal_select')}}";
var urlT = "{{asset('/vista_principal_tarea')}}";
var urlD = "{{asset('/vista_principal_eliminar/')}}";

var imagenRedireccionar = "{{asset('/images/redireccionar.svg')}}";
</script>




@stop
