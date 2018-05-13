<h1>Hola {{$usuario->__toString()}}</h1>
  <h2>  Da clic en el botón que aparece a continuación para ver mas detalles de la minuta de reunion.</h2><br><br>
    <a href="{{asset('/pdf_minuta')}}/{{$id_reunion}}/{{$codigo}}"
    style="  text-decoration: none;
      padding: 10px;
      font-weight: 600;
      font-size: 20px;
      color: white;
      background-color:#FA8072;
      border-radius: 6px;
      border: 2px solid #FA8072;"> ver minuta</a><br><br><br>
