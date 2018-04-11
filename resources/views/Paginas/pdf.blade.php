  <div>
    <div>
      <p>{{$fecha_creacion}}</p>
    </div>
    <div>
      <img src="{{$imagen}}" style="float: right !important;" width="150" height="150">
    </div>
  </div>
  <h2>SisMin</h2>
  <h4>Motivo: {{$motivo}}</h4>
  <h5>Convocados</h5>
  <ul>
    @foreach ($convocados as $convocado)
        <li>{{$convocado->usuario->__toString()}}</li>
    @endforeach
  </ul>
  <h5>Para tratar los siguientes temas</h5>
  @foreach($reunion_orden_dia as $tema)
  <ol>{{$tema->descripcion}} => {{$tema->usuario}}</ol>
  @endforeach
  <p>Fecha de la reunión: {{$fecha_reunion}}</p>
  <br/>
  <p>Lugar:{{$lugar}}</p>
  <h3>Atte:{{$convocados->get(0)->usuario}} (Moderador)</h3>
