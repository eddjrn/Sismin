@extends('Layout.layout')

@section('titulo')
Pendientes
@stop

@section('estilos')

@stop

@section('cabecera')

@stop

@section('contenido')
<!-- Tabs With Icon Title -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">list</i> Compromisos.
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#profile_with_icon_title" data-toggle="tab">
                            <i class="material-icons">library_books</i> Orden del día.
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#messages_with_icon_title" data-toggle="tab">
                            <i class="material-icons">assignment_turned_in</i> Temas pendientes.
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                      <div class="body table-responsive bar" style="height: 300px; overflow-y: scroll;">
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Fecha límite</th>
                                      <th>Descripción</th>
                                      <th>Tipo de reunión</th>
                                      <th>Responsable-Tarea</th>
                                      <th>Estatus</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($compromisos as $c=>$compromiso)
                                <tr>
                                    <th scope="row">{{$compromiso->fecha_limite}}</th>
                                    <td>{{$compromiso->orden_dia->descripcion}}</td>
                                    <td>{{$compromiso->minuta->reunion->tipo_reunion->descripcion}}</td>
                                    <td>
                                  @foreach($compromisos[$c]->responsables as $responsable)
                                         <b>{{$responsable->usuario->__toString()}}:</b> {{$responsable->tarea}}<br>
                                    @endforeach
                                  </td>
                                  @if($compromiso->finalizado ==1)
                                    <td>Finalizado</td>
                                  @else
                                    <td>En proceso</td>
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
                                              <th>Orden del día</th>
                                              <th>Motivo por el que quedo pendiente</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($listado as $temaP)
                                        <tr>
                                            <th scope="row">{{$temaP->tema_pendiente->minuta->reunion->fecha_reunion}}</th>
                                            <!-- <td>{{$temaP->reunion->tipo_reunion->descripcion}}</td>
                                            <td>{{$temaP->descripcion}}</td>
                                            <td>{{$temaP->descripcion_hechos}}</td> -->
                                        </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Tabs With Icon Title -->
@stop

@section('scripts')

@stop
