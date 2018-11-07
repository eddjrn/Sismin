@extends('Layout.layout')

@section('titulo')
Respaldo
@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('/css/treeview/easyTree.css')}}" rel="stylesheet" />
@stop

@section('cabecera')
Respaldo
@stop

@section('contenido')
@if(count($reuniones) > 0)
<?php $icono_vacio = false; ?>
<div class="card">
    <div class="body">
      <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
              <a href="#home_with_icon_title" data-toggle="tab">
                  <i class="material-icons">schedule</i> Respaldo activo: <b>{{config('variables.recuperacion')}} </b>
              </a>
          </li>
      </ul>
      <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
        <b>A continuación se enlistan todas las reuniones del respaldo activo con sus respectivas minutas y convocatorias.</b>
        <ul class="treeview">
        @foreach($reuniones as $reunion)
        <li><a class="col-black label bg-pink">Reunión:</a><span> {{$reunion->tipo_reunion->descripcion}}</span>
          <ul id="minutasLista_{{$reunion->minuta->id_minuta}}">
            <li><i class="tree-indicator glyphicon glyphicon-info-sign"></i><span>Motivo: {{$reunion->motivo}} </span></li>
            <li><i class="tree-indicator glyphicon glyphicon-calendar"></i><span>Fecha de la reunión: {{$reunion->getFechaReunionLegible()}} </span></li>
            <li><i class="tree-indicator glyphicon glyphicon-user"></i><span>Moderador: {{$reunion->moderador}} </span></li>
            <li><i class="tree-indicator glyphicon glyphicon-user"></i><span>Secretario: {{$reunion->secretario}} </span></li>
            <li><a href="{{asset('/pdf_respaldo')}}/{{$reunion->id_reunion}}/{{$reunion->codigo}}" class="font-bold texto" target="_blank"><i class="tree-indicator glyphicon glyphicon-file"></i>Ver convocatoria</a></li>
            <li><a href="{{asset('/pdf_minuta_respaldo')}}/{{$reunion->minuta->id_minuta}}/{{$reunion->minuta->codigo}}" class="font-bold texto" target="_blank"><i class="tree-indicator glyphicon glyphicon-file"></i>Ver minuta</a></li>
        </ul>
        </li>
        @endforeach
        </ul>
        @else
        <?php $icono_vacio = true; ?>
        @endif
      </div>
    </div>
  </div>
</div>

@if($icono_vacio)
  <img src="{{asset('/images/iconoFull_gris.svg')}}" style="display: block; margin: auto;" width="250" height="250"/>
  <h2 class="align-center col-blue-grey">No hay respaldo activo en esta sección</h2>
  <h2 class="align-center col-blue-grey"><i class="material-icons">tag_faces</i></h2>
@endif
@stop

@section('scripts')
<script src="{{asset('/js/treeview/easyTree.js')}}"></script>
<script>
$(function (){
  $('.treeview').each(function () {
     var tree = $(this);
     tree.treeview();
   });
})
</script>
@stop
