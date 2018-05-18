@extends('Layout.layout')

@section('titulo')
Pendientes
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('/css/treeview/easyTree.css')}}" rel="stylesheet" />
@stop

@section('cabecera')
Pendientes
@stop

@section('contenido')
<!-- Tabs With Icon Title -->
@if(count(Auth::user()->convocado_en) > 0)
<?php $icono_vacio = false; ?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-col-pink" role="tablist">
                    @if(count($compromisos) > 0)
                    <li role="presentation" class="active">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">list</i> Compromisos.
                        </a>
                    </li>
                    @endif
                    @if(count($listado)>0)
                    <li role="presentation">
                        <a href="#profile_with_icon_title" data-toggle="tab">
                            <i class="material-icons">library_books</i> Orden del día.
                        </a>
                    </li>
                    @endif
                    @if(count($temas) > 0)
                    <li role="presentation">
                        <a href="#messages_with_icon_title" data-toggle="tab">
                            <i class="material-icons">assignment_turned_in</i> Temas pendientes.
                        </a>
                    </li>
                    @endif
                    @if(count(Auth::user()->reuniones_historial()) > 0)
                    <li role="presentation">
                        <a href="#minutas" data-toggle="tab">
                            <i class="material-icons">picture_as_pdf</i>Historial.
                        </a>
                    </li>
                    @endif
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">
                      <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Fecha límite</th>
                                      <th>Descripción</th>
                                      <th>Tipo de reunión</th>
                                      <th>Responsable-Tarea</th>
                                      <th>Estatus de la tarea</th>
                                      <th>Estatus del compromiso</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($compromisos as $c=>$compromiso)
                                <tr>
                                    <th scope="row">{{$compromiso->fecha_limite}}</th>
                                    <td>{{$compromiso->descripcion}}</td>
                                    <td>{{$compromiso->minuta->reunion->tipo_reunion->descripcion}}</td>
                                    <td>
                                  @foreach($compromisos[$c]->responsables as $rsp)
                                         <b>{{$rsp->usuario->__toString()}}:</b> {{$rsp->tarea}}<br>

                                    @endforeach
                                  </td>
                                  @if(Auth::User()->responsable_en[$c]->realizado ==1)
                                    <td>
                                      <input type="checkbox" id="estatus_{{Auth::User()->responsable_en[$c]->id_compromiso_resp}}" class="chk-col-pink" onclick="actualizarEstatus({{$compromiso->id_compromiso}});" checked disabled/>
                                      <label for="estatus_{{Auth::User()->responsable_en[$c]->id_compromiso_resp}}">Finalizado</label>
                                    </td>
                                  @else
                                  <td>
                                    <input type="checkbox" id="estatus_{{Auth::User()->responsable_en[$c]->id_compromiso_resp}}" class="chk-col-pink" onclick="actualizarEstatus('{{Auth::User()->responsable_en[$c]->tarea}}',{{Auth::User()->responsable_en[$c]->id_compromiso_resp}});" autocomplete="off"/>
                                    <label for="estatus_{{Auth::User()->responsable_en[$c]->id_compromiso_resp}}">En proceso</label>
                                  </td>
                                  @endif
                                </td>
                                @if($compromiso->finalizado ==1)
                                  <td>
                                    <input type="checkbox" id="estatus" class="chk-col-pink"  checked disabled/>
                                    <label>Finalizado</label>
                                  </td>
                                @else
                                <td>

                                  <label>En proceso</label>
                                </td>
                                @endif
                                </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                        <b>El listado de los temas que se muestran a continuación son los que usted tiene que presentar en la reunión correspondiente.</b>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                              <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                              <th>Fecha de reunion</th>
                                              <th>Reunión</th>
                                              <th>Descripción</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($listado as $orden)
                                        <tr>
                                            <th scope="row">{{$orden->reunion->fecha_reunion}}</th>
                                            <td>{{$orden->reunion->tipo_reunion->descripcion}}</td>
                                            <td>{{$orden->descripcion}}</td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                    </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                        <b>Listado de los temas que no se pudieron concluir la reunión pasada y que usted tuvo que presentar.</b>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                              <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                              <th>Fecha de reunion</th>
                                              <th>Reunión</th>
                                              <th>Orden del día a la que pertenece</th>
                                              <th>Descripción del tema pendiente</th>
                                              <th>Motivo por el que quedo pendiente</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($temas as $temaP)
                                        <tr>
                                            <th scope="row">{{$temaP->minuta->reunion->fecha_reunion}}</th>
                                            <td>{{$temaP->minuta->reunion->tipo_reunion->descripcion}}</td>
                                            <td>{{$temaP->orden_dia->descripcion}}</td>
                                            <td>{{$temaP->descripcion}}</td>
                                            <td>{{$temaP->orden_dia->descripcion_hechos}}</td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                    </div>
                </div>
                    <div role="tabpanel" class="tab-pane fade" id="minutas">
                      <b>A continuación se enlistan las reuniones pasadas con sus respectivas minutas y convocatorias.</b>
                      <ul class="treeview">
                      <?php $reuniones=  Auth::user()->reuniones_historial(); ?>
                      @foreach($reuniones as $reunion)
                      <li><a class="col-black label fondo">Reunión:</a><span> {{$reunion->tipo_reunion->descripcion}}</span>
                        <ul id="minutasLista_$reunion->minuta->id_minuta">
                          <li><i class="tree-indicator glyphicon glyphicon-info-sign"></i><span>Motivo: {{$reunion->motivo}} </span></li>
                          <li><i class="tree-indicator glyphicon glyphicon-calendar"></i><span>Fecha de la reunión: {{$reunion->fecha_reunion}} </span></li>
                          <li><i class="tree-indicator glyphicon glyphicon-user"></i><span>Moderador: {{$reunion->moderador()}} </span></li>
                          <li><i class="tree-indicator glyphicon glyphicon-user"></i><span>Secretario: {{$reunion->secretario()}} </span></li>
                          <li><a href="{{asset('/pdf')}}/{{$reunion->id_reunion}}/{{$reunion->codigo}}" class="font-bold texto" target="_blank"><i class="tree-indicator glyphicon glyphicon-file"></i>Ver convocatoria</a></li>
                          <li><a href="{{asset('/pdf_minuta')}}/{{$reunion->minuta->id_minuta}}/{{$reunion->minuta->codigo}}" class="font-bold texto" target="_blank"><i class="tree-indicator glyphicon glyphicon-file"></i>Ver minuta</a></li>
                      </ul>
                      </li>
                      @endforeach
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@else
<?php $icono_vacio = true; ?>
@endif

@if($icono_vacio)
  <img src="{{asset('/images/iconoFull_gris.svg')}}" style="display: block; margin: auto;" width="250" height="250"/>
  <h2 class="align-center col-blue-grey">No tienes pendientes en esta sección</h2>
  <h2 class="align-center col-blue-grey"><i class="material-icons">tag_faces</i></h2>
@endif
<!-- #END# Tabs With Icon Title -->

<div class="modal fade" id="estatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Cambiar estatus a finalizado</h4>
            </div>
            <div class="modal-body">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">list</i>
                  </span>
                  <div class="form-line">
                      <label>El estatus de éste compromiso se cabiará a finalizado, ¿desea continuar?</label>
                  </div>
              </div>
              <div class="modal-footer row clearfix">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button type="button" onclick="checkD();" id="btnCancelarE" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button  type="button" onclick="actualizarE();" id="btnAsignarE" name="btnAsignarE" class="btn bg-pink btn-block waves-effect" data-dismiss="modal">Continuar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{asset('/js/paginas/pendientes.js')}}"></script>
<script src="{{asset('/js/treeview/easyTree.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var urlE = "{{asset('/pendientes')}}";
var urlToRedirectPage = "{{asset('/pendientes')}}";

var imagenRedireccionar = "{{asset('/images/redireccionar.svg')}}";
</script>

@stop
