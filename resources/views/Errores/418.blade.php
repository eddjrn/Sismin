@extends('Layout.layout3')

@section('titulo')
I'm a teapot
@stop

@section('codigo')
418
@stop

@section('mensaje')
{{$exception->getMessage()}}... :(
<br/>
<i class="material-icons">help_outline</i>
@stop
