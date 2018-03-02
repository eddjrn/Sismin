@extends('Layout.layout')

@section('title')
Página principal
@stop

@section('estilos')
<script src="{{asset('/js/atrament.min.js')}}"></script>

@stop

@section('header')

@stop

@section('contenido')
<form>
  <button id="clear" onclick="event.preventDefault(); atrament.clear();" class="btn btn-block bg-pink waves-effect ">clear</button><br>
</form>
<canvas id="sketcher"></canvas>

@stop

@section('scripts')
<script>
  var canvas = document.getElementById('sketcher');
  var atrament = atrament(canvas, window.innerWidth, window.innerHeight);

  var clearButton = document.getElementById('clear');
  canvas.addEventListener('dirty', function(e) {
    clearButton.style.display = atrament.dirty ? 'inline-block' : 'none';
  });
</script>
@stop
