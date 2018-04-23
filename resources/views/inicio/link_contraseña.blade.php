
<strong style="padding:0;margin:0;line-height:1px;font-size:1px;font-family:'HelveticaNeue',
'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:24px;line-height:32px;
font-weight:bold;color:#292f33;text-align:left;text-decoration:none"> ¿Restablecer tu contraseña?</strong>
<h2>Hola {{$usuario->__toString()}}</h2>
  <p align="justify" style="padding:0;margin:0;line-height:1px;font-size:1px;font-family:'HelveticaNeue',
  'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;
  line-height:20px;font-weight:400;color:#292f33;text-align:left;text-decoration:none">
  Hemos recibido una petición para restablecer la contraseña de tu cuenta en SisMin, haz clic en el botón que aparece a continuación para restablecer tu contraseña.<br>
</p><br><br><br>

  <a href="{{asset('/cambiar_password')}}/{{$usuario->correo_electronico}}/{{$codigo}}" style="  text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: white;
    background-color:#FA8072;
    border-radius: 6px;
    border: 2px solid #FA8072;"> Restablecer contraseña </a><br><br><br>

  <h3>Gracias,<br>
  Sistema auxiliar en la elaboración y seguimiento de las minutas de reuniones de trabajo.<h3>
