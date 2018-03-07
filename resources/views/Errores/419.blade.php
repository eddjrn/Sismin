@extends('Layout.layout3')

@section('titulo')
La página expiró
@stop

@section('codigo')
419
@stop

@section('mensaje')
La página expiró debido a inactividad...
<br/>
<h4><p class="font-italic">Puede probar de nuevo recargando la página.</p></h4>
<i class="material-icons">hourglass_empty</i>
@stop
