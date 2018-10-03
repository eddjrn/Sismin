var convocados = [];
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
       $('#tipo_reunion').html(result.datos[3][8]);
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
        $('#secretario').html(result.datos[3][5]);
        if(result.datos[3][6]==result.datos[3][7] || result.datos[3][7] == result.datos[3][11]){
          var id_convocados = [];
          id_convocados = result.datos[4];
        if(result.datos[3][12]== 1 && result.datos[3][6]==result.datos[3][7]){
          $('#realizarMinuta').show();
          $('#realizarMinuta').attr('onClick',`realizarMinuta(${result.datos[3][10]},"${result.datos[3][9]}")`);
        }else{
          $('#realizarMinuta').hide();
        }
          $('#delegarResp').attr('onClick',`delegarResp(\
            ${result.datos[0]['id_reunion']},\
            "${result.datos[3][8]}",\
            [${id_convocados}])`);
              convocados = result.datos[1];
        }else {
          $('#realizarMinuta').hide();
          $('#delegarResp').hide();
        }
        if(result.datos[3][7] == result.datos[3][11]){
          $('#eliminarReunion').show();
          $('#eliminarReunion').attr("onClick", `eliminarReunion(2, ${id_reunion}, "${result.datos[3][9]}");`);
        } else{
          $('#eliminarReunion').hide();
          $('#eliminarReunion').attr("onClick", "");
        }

        $('#detalles_reunion').show(200);
      },
      error: function (jqXHR, status, error) {
       mensajeAjax('Error', error, 'error');
      }
    })
  }

  function delegarResp(id_reunion,tipo_reunion,id_convocados){
    $('#responsabilidadModal').modal('show');
    $('#tipoReunion').html(tipo_reunion);
    $('#Copc').html(``);
    $('#Copc').selectpicker('refresh');
    for (var i = 0; i < id_convocados.length; i++) {
      $('#Copc').html($('#Copc').html()+`<option value="${id_convocados[i]}">${convocados[i]}</option>`);
    }
  $('#Copc').selectpicker('refresh');
  $('#actualizarSecre').attr('onClick',`actualizarSecre(${id_reunion})`);

  }

 function actualizarSecre(id_reunion){
   var id_convocado = $('#Copc').val();

   $.ajax({
      type:'POST',
      url: urlS,
      data:
      {
        "id_reunion":id_reunion,
        "id_convocado": id_convocado
      },
      success:function(result){
        if(result.errores){
          var errores = '<ul>';
          $.each(result.errores,function(indice,valor){
            errores += '<li>' + valor + '</li>';
          });
          errores += '</ul>';
          notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
        } else{
          mensajeAjax('Registro correcto', result.mensaje,'success');
          window.setTimeout(function(){
            location.href = urlToRedirectPage;
          } ,1500);
        }
     },
     error: function (jqXHR, status, error) {
      mensajeAjax('Error', error, 'error');
     }
   });
 }

function realizarMinuta(id,codigo){
  mensajeAjaxIcono("Redireccionando", "Nueva minuta...", imagenRedireccionar);
  window.setTimeout(function(){
    location.href = urlToRedirectPage+`minuta/${id}/${codigo}`;
  } ,1500);
}

function eliminarReunion(opcion, id_reunion, codigo){
  switch(opcion){
    case 1:
    inicioSpinner();
    urlD2 = urlD + "/" + id_reunion + "/" + codigo;
    $.ajax({
       type:'POST',
       url: urlD2,
       data:
       {
         "clave": $('#claveDel').val(),
       },
       success:function(result){
         if(result.errores){
            finSpinner();
           var errores = '<ul>';
           $.each(result.errores,function(indice,valor){
             errores += '<li>' + valor + '</li>';
           });
           errores += '</ul>';
           notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
         } else{
           mensajeAjax('Eliminando reunión', result.mensaje,'warning');
           window.setTimeout(function(){
             location.href = urlToRedirectPage;
           } ,1500);
         }
      },
        error: function (jqXHR, status, error) {
          finSpinner();
         mensajeAjax('Error', error, 'error');
        }
      });
      break;
    case 2:
      $('#btnEliminarModal').attr("onClick", `eliminarReunion(1, ${id_reunion}, "${codigo}")`);
      $('#eliminarModal').modal('show');
      break;
  }
}


function asignarT(id_compromiso_resp){
  $('#tareaModal').modal('show');
  $('#btnAsignarT').attr('onClick',`actualizarTarea(${id_compromiso_resp})`);
}

function actualizarTarea(id){
  var tarea = $('#tarea').val();

  $.ajax({
     type:'POST',
     url: urlT,
     data:
     {
       "id_compromiso_resp":id,
       "tarea": tarea
     },
     success:function(result){
       if(result.errores){
         var errores = '<ul>';
         $.each(result.errores,function(indice,valor){
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       } else{
         mensajeAjax('Registro correcto', result.mensaje,'success');
         window.setTimeout(function(){
           location.href = urlToRedirectPage;
         } ,1500);
       }
    },
    error: function (jqXHR, status, error) {
     mensajeAjax('Error', error, 'error');
    }
  });
}
