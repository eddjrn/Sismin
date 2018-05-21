<h1>Hola {{$usuario->__toString()}}</h1>
  <h2> El moderador {{$reunion->moderador}} eliminó la reunión {{$reunion->tipo_reunion->descripcion}}, convocada para el dia {{$reunion->getFechaReunionLegible()}}.</h2><br><br>
