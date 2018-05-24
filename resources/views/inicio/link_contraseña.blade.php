<strong style="padding:0;margin:0;line-height:1px;font-size:1px;font-family:'HelveticaNeue',
'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:24px;line-height:32px;
font-weight:bold;color:#292f33;text-align:left;text-decoration:none"> ¿Restablecer tu contraseña?</strong>
<h2>Hola {{$usuario->__toString()}}</h2>
  <p align="justify" style="padding:0;margin:0;line-height:1px;font-size:1px;font-family:'HelveticaNeue',
  'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;
  line-height:20px;font-weight:400;color:#292f33;text-align:left;text-decoration:none">
  Hemos recibido una petición para restablecer la contraseña de tu cuenta en SisMin, haz clic en el botón que aparece a continuación para restablecer tu contraseña.<br>
</p><br><br><br>

  <div align="center">
    <a href="{{asset('/cambiar_password')}}/{{$usuario->correo_electronico}}/{{$codigo}}" style="  text-decoration: none;
      padding: 10px;
      font-weight: 60;
      font-size: 20px;
      color: white;
      background-color:#E91E63;
      border-radius: 2px;
      border: 2px solid #E91E63;
      box-shadow: 0 3px 6px rgba(0,0,0,0.12), 0 3px 6px rgba(0,0,0,0.12);
      "> Restablecer contraseña </a>
    <br><br><br>

    <h5>Gracias,<br>
    Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.
    </h5>
  </div>

  <br>
      <img src="{{asset('/images/correo.svg')}}" width="150" height="150" style="display: block; margin-left: auto; margin-right: auto;"/>
  <br>
