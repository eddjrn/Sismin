<h1>Hola {{$usuario->__toString()}}</h1>
  <h2>  Da clic en el botón que aparece a continuación para ver mas detalles de la minuta de reunion.</h2><br><br>
  <div align="center">
    <a href="{{asset('/pdf_minuta')}}/{{$id_reunion}}/{{$codigo}}"
    style="  text-decoration: none;
    padding: 10px;
    font-weight: 60;
    font-size: 20px;
    color: white;
    background-color:#E91E63;
    border-radius: 2px;
    border: 2px solid #E91E63;
    box-shadow: 0 3px 6px rgba(0,0,0,0.12), 0 3px 6px rgba(0,0,0,0.12);
    "> ver minuta </a><br><br><br>
    <h5>Gracias,<br>
    Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.
    </h5>
  </div>

  <br>
      <img src="{{asset('/images/correo.svg')}}" width="150" height="150" style="display: block; margin-left: auto; margin-right: auto;"/>
  <br>
