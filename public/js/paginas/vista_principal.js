function mostrar(id_reunion){
//  alert(reunion);

    $.ajax({
     type:'POST',
     url: url,
     data:
     {
       "id_reunion":id_reunion
     },
     success:function(result){
       //alert(result.datos[3][0].toString());
       $('#moderador').html(result.datos[3][0]);
       $('#moderador2').html(result.datos[3][0]);
       $('#fecha_reunion').html(result.datos[3][1]);
       $('#motivo').html(result.datos[0]['motivo']);
       $('#listaConvocados').html('<tr>');
       for (var i = 0; i < result.datos[1].length; i++) {
        $('#listaConvocados').html($('#listaConvocados').html()+`\
            <th>${result.datos[1][i]}</th>\
            <th>${result.datos[2][i]}</th>\
        `);
        }
      $('#listaConvocados').html($('#listaConvocados').html()+'</tr>');
      $('#convocados3').html(result.datos[1].length);
      $('#imgReunion').attr('src',result.datos[3][4]);
      $('#secretario').html(result.datos[3][0]);
      },
      error: function (jqXHR, status, error) {
       mensajeAjax('Error', error, 'error');
      }
    })
  }
