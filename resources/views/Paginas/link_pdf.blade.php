<h1>Hola {{$usuario->__toString()}}</h1>
  <p>
    Da clic en el siguiente enlace para ver mas detalles de la reunión a la que fuiste convocado(a).
    <a href="{{asset('/pdf')}}/{{$id_reunion}}/{{$codigo}}"> clic aquí</a>
  </p>
