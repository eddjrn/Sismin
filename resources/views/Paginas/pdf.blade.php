   <title>Convocatoria de la reunión {{$tipo}} </title>
   <div align="right"><img src="{{$imagen}}" class="logo" width="100" height="100"></div>
  <div class="DR" align="justify">
      <center><h1>"{{$tipo}}"</h1></center>
    <b>Por medio de la presente, se le convoca a {{$motivo}} para el día {{$fecha_reunion}}, en {{$lugar}}.</b><br><br>
<b>Convocados:</b><hr>
  <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Rol dentro de la reunión</th>
        </tr>
      </thead>
      <tbody>
        @foreach($convocados as $convocado)
        <tr>
          <td>{{$convocado->usuario->__toString()}}</td>
          <td>{{$convocado->rol->descripcion}}</td>
        @endforeach
      </tbody>
  </table>

  <b>Para tratar los siguientes temas:</b><hr>
  <ol>
      @foreach($reunion_orden_dia as $tema)
    <li><b>Tema:</b> {{$tema->descripcion}}.
      <ul>
        <li><b>Responsable: </b>{{$tema->usuario}}.</li>
      </ul>
    </li>
    @endforeach
  </ol>

  <p class="fecha_hoy"><b>{{$fecha_creacion}}</b></p>
  Atentamente:
      <center><img src="{{$img}}" class="rubrica" width="150" height="150" /></center>
  <hr class="hrR">
  <h3>{{$convocados->get(0)->usuario}}<br> (Moderador)</h3></div>

<style>
.logo{
  margin-top: 0;
  padding-top: 0;
  margin: 1rem;
  padding: 1rem;
  border-radius:50%;
-webkit-border-radius:50%;
}
.fecha_hoy{
  font-family:"Verdana";
  font-size: 16px;
  font-style: oblique;
 /* IMPORTANTE */
 text-align: right;
}
.DR{
  margin-top: 0;
  padding-top: 0;
  margin: 1rem;
  padding: 1rem;
  font-size: 16px;
}

ul {
    list-style-type:square;
}
ol {
    list-style-type: decimal-leading-zero;
    padding-left: 2em;
      font-style: italic;
}
.hrR{
    width: 50%;
}

h3{
  font-family:"Verdana";
  font-size: 14px;
  font-style: oblique;
   /* IMPORTANTE */
   text-align: center;
}
table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
  background-color: transparent;
  border-spacing: 0;
  border-collapse: collapse;
}
th, td {
    text-align: left;
    padding: 2px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
