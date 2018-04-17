    <div align="right"><img src="{{$imagen}}" class="logo" width="100" height="100"></div>
    <center><h1 class="tipo">"{{$tipo}}"</h1></center>
  <h2 align="justify">Por medio de la presente, se le convoca a {{$motivo}} para el día {{$fecha_reunion}}, en {{$lugar}}.<br><br>
  Convocados:</h2>
    <ul class="convocado">
    @foreach ($convocados as $convocado)
        <li>{{$convocado->rol}}: {{$convocado->usuario->__toString()}}</li>
    @endforeach
  </ul>
  <h2>Para tratar los siguientes temas:</h2>
  <ol class="convocado">
  @foreach($reunion_orden_dia as $tema)
    <li>{{$tema->descripcion}} => {{$tema->usuario}}</li>
  @endforeach
</ol>
  <p class="fecha_hoy"><b>{{$fecha_creacion}}</b></p>
  <div >Atentamente:
      <center><img src="{{$img}}" class="rubrica" width="150" height="150" /></center>
  <hr>
  <h3>{{$convocados->get(0)->usuario}}<br> (Moderador)</h3></div>

<style>
.logo{
  border-radius:50%;
-webkit-border-radius:50%;
margin: 1rem;
padding: 1rem;
}
.primer{
  margin: 1rem;
  padding: 1rem;
  /* IMPORTANTE */
  text-align: center;
}
.fecha_hoy{
  margin: 1rem;
  padding: 1rem;
  font-family: "Times New Roman", Times, serif;
  font-size: 14px;
  font-style: oblique;
 /* IMPORTANTE */
 text-align: right;
}

.tipo{
  font-family: "Times New Roman", Times, serif;
  font-size: 22px;
}
h2{
  margin-top: 0;
  padding-top: 0;
  margin: 1rem;
  padding: 1rem;
  font-family: "Times New Roman", Times, serif;
  font-size: 16px;
}
.convocado{
  padding-left:2rem;
  margin-left: 2rem;
  padding-top: 0;
  margin-top: 0;
  font-family: "Times New Roman", Times, serif;
  font-size: 16px;
  font-style: italic;
}
ul {
    list-style-type: square;
}
ol {
    list-style-type: decimal-leading-zero;
    padding-left: 2em;
}
hr{
    width: 50%;
}

h3{
  font-family: "Times New Roman", Times, serif;
  font-size: 14px;
  font-style: oblique;
   /* IMPORTANTE */
   text-align: center;
}

</style>
