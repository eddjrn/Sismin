@extends('Layout.layout')

@section('titulo')

@stop

@section('estilos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('/css/treeview/easyTree.css')}}" rel="stylesheet" />
@stop

@section('cabecera')

@stop

@section('contenido')
<div class="card">
    <div class="body">
        <b>A continuación se enlistanm todas las reuniones del respaldo activo con sus respectivas minutas y convocatorias.</b>
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
    </div>
</div>
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
