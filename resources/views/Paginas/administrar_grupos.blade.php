@extends('Layout.layout')

@section('titulo')
Administrar grupos
@stop

@section('estilos')
<!--cabecera para que se puedan enviar peticiones POST desde javascript-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta http-equiv="Pragma" content="no-cache">
<!-- Bootstrap Select Css -->
<link href="{{asset('/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>
<!-- JQuery DataTable Css -->
<link href="{{asset('/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop


@section('cabecera')

@stop

@section('contenido')
<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
@foreach($grupos as $index => $grupo)
<div class="panel panel-col-pink">
    <div class="panel-heading" role="tab" id="heading{{$index}}_1">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse{{$index}}_1" aria-expanded="true" aria-controls="collapse{{$index}}_1">
                <i class="material-icons">group</i>
                {{$grupo->descripcion}}
            </a>
        </h4>
    </div>
    <div id="collapse{{$index}}_1" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{$index}}_1">
        <div class="panel-body">
          <ol id='usuarios_{{$grupo->id_tipo_reunion}}'>
            @foreach($grupo->usuarios as $usuario)
            @if($usuario->estatus == '1')
            <li id="usr_{{$usuario->id_usuario}}">
             {{$usuario->__toString()}}
            </li>
            @else
            <li id="usr_{{$usuario->id_usuario}}">
             {{$usuario->__toString()}} <label class="font-bold col-pink">-> inactivo</label>
            </li>
            @endif
            @endforeach
          </ol>
        <center>
          <button type="button" id="btnUsr_{{$grupo->id_tipo_reunion}}" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#modalUsr" onclick="agregarUsr({{$grupo->id_tipo_reunion}},{{$grupo->usuarios}})">
            <i class="material-icons">add_circle_outline</i>
            <span>Agregar usuarios</span>
          </button>
        </center>
        </div>
    </div>
</div>
@endforeach
</div>

<div class="modal fade" id="modalUsr" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel2">Agreagar usuarios al grupo <span id='usr'> </span></h4>
            </div>
            <div class="modal-body" >
              <div class="table-responsive bar" style="height: 350px; overflow-y: scroll;">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Agregar</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                            <th>Nombre</th>
                            <th>Agregar</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($usuarios as $usuario)
                        @unless($usuario->id_usuario == Auth::user()->id_usuario)
                        <tr>
                          <td id="nombre_{{$usuario->id_usuario}}">{{$usuario->__toString()}}</td>
                          <td>
                            <div class="row">
                              <div class="col-lg-12">
                                <input type="checkbox" onClick="actualizarChek(this);" id="usr2_{{$usuario->id_usuario}}" class="chk-col-teal" autocomplete="off"/>
                                <label for="usr2_{{$usuario->id_usuario}}" id="ckek_usr2_{{$usuario->id_usuario}}">Agregar usuario</label>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endunless
                      @endforeach
                      </tbody>
                  </table>
              </div>

            <div class="modal-footer">
              <div class="row">
                <center>
                  <button type="button" class="btn bg-pink waves-effect" data-dismiss="modal" onclick="checkFalse()">Cancelar</button>
                  <button type="button" class="btn bg-pink waves-effect" data-dismiss="modal" id="guardar" onclick="guardarC()">Aceptar</button>
                </center>

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

<script src="{{asset('/js/paginas/grupos.js')}}"></script>
@stop
