<h1>Hola {{$usuario->__toString()}}</h1>
  <p>
    Da clic en el siguiente enlace para reestablecer tu contraseña de SisMin.
    <a href="{{config('app.url')}}/cambiar_password/{{$usuario->correo_electronico}}/{{$codigo}}"> clic aquí</a>
  </p>
