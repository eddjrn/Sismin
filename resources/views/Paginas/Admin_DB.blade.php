@extends('Layout.layout')

@section('titulo')
Respaldos
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Bootstrap Select Css -->
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>
<!-- JQuery DataTable Css -->
<link href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('cabecera')
Respaldos
@stop

@section('contenido')
<!-- Tabs With Icon Title -->
<h6>El archivo: {{config('variables.recuperacion')}} esta activado.</h6>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-col-pink" role="tablist">
                  <li role="presentation">
                        <a href="#home_with_icon_title" data-toggle="tab">
                            <i class="material-icons">schedule</i> Realización de respaldos.
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#profile_with_icon_title" data-toggle="tab">
                            <i class="material-icons">restore</i> Recuperación de respaldos.
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title">
                      <strong>Para realizar un respaldo de toda la base de datos de las minutas y reuniones presione el botón realizar respaldo.</strong>
                      <br>
                      <button type="button" id="btnRespaldo" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#modalRespaldo">
                        <i class="material-icons">file_download</i>
                        <span>Realizar respaldo</span>
                      </button>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                      <div class="table-responsive bar" style="height: 350px; overflow-y: scroll;">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th style="width: 400px !important">Fecha</th>
                                      <th style="width: 400px !important">Acción</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th>Nombre</th>
                                      <th style="width: 100px !important">Fecha</th>
                                      <th style="width: 100px !important">Acción</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  @foreach($archivos as $archivo)
                                    <tr>
                                      <td id="">{{$archivo}}</td>
                                      <td>fecha</td>
                                      <td>
                                        <button type="button" class="btn bg-red waves-effect" data-dismiss="modal" onclick="activar('{{$archivo}}')" @if(config('variables.recuperacion') == $archivo)disabled="disabled"@endif>
                                          @if(config('variables.recuperacion') == $archivo)
                                            <i class="material-icons">lock</i>
                                            <span>Activado</span>
                                          @else
                                            <i class="material-icons">present_to_all</i>
                                            <span>Activar</span>
                                          @endif
                                        </button>
                                        <br class="hidden-lg hidden-md hidden-sm">
                                        <br class="hidden-lg hidden-md hidden-sm">
                                        <button type="button" class="btn bg-pink waves-effect" onclick="descargar('{{$archivo}}')">
                                          <i class="material-icons">file_download</i>
                                          <span>Descargar</span>
                                        </button>
                                      </td>
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

<div class="modal fade" id="modalRespaldo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel2">Realizar respaldo</label></h4>
            </div>
            <div class="modal-body" >
              <blockquote class="font-15">
                <p class="align-justify">
                  Al realizar éste tipo de respaldo, los datos existentes en el sistema (Toda información relacionada con las minutas y convocatorias de reunión) serán limpiados y pasados a un respaldo.
               </p>
             </blockquote>
                <p class="font-bold col-pink align-center"> ¿Desea continuar?</p>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-block bg-pink waves-effect" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-md-6">
                  <button type="button" class="btn btn-block bg-pink waves-effect" data-dismiss="modal" id="realizarR" onclick="respaldo()">Aceptar</button>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script src="{{asset('/js/treeview/easyTree.js')}}"></script>
<!-- Select Plugin Js -->
<script src="{{asset('/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<!-- Multi Select Plugin Js -->
<script src="{{asset('/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>


<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var colorSpinner = '#E91E63';
var url = "{{asset('/')}}";
</script>

<script src="{{asset('/js/paginas/admin_DB.js')}}"></script>
@stop
