var individuos = [];
var grupo = 0 ;
var formulario = new FormData();
// Función al recargar la página, cambia estilos e inicaliza scripts en español
$(function () {
  // Data table plugin
  $('.js-basic-example').DataTable({
      responsive: true,
      "language": {
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "zeroRecords": "No encontrado - lo siento",
          "info": "Página _PAGE_ de _PAGES_",
          "infoEmpty": "No hay registros disponibles",
          "infoFiltered": "(Se filtró de _MAX_ registros totales)",
          "search": "Buscar",
          "paginate": {
              "previous": "<",
              "next": ">"
            }
      },
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]],
      "autoWidth": false,
  });
});

function agregarUsr(id_grupo){
  grupo = id_grupo;
  formulario.set('id_grupo',grupo);
var usuarios = $('#usuarios_'+id_grupo).children();
  $(usuarios).each(function(){
    individuos.push($(this).attr('id').split('_')[1]);
      for (var i = 0; i < individuos.length; i++)
      {
         $('#usr2_'+individuos[i]).prop("checked", true);
         $('#ckek_usr2_'+individuos[i]).html("Éste usuario ya pertenece al grupo/Eliminar");
      }
  });
}

function checkFalse(){
  $('input:checkbox').removeAttr('checked');
  for(var j=0; j<individuos.length; j++)
    {
      $('#ckek_usr2_'+individuos[j]).html("Agregar usuario");
    }
 individuos.length = 0;
}

function actualizarChek(chek){
    var id_usr = chek.id.split("_");
   var index = individuos.indexOf(id_usr[1]);
  if(chek.checked){
    $('#ckek_usr2_'+id_usr[1]).html("Éste usuario ya pertenece al grupo/Eliminar");
    individuos.push(id_usr[1]);

  }else{
    $('#ckek_usr2_'+id_usr[1]).html("Agregar usuario");
      if (index > -1) {
        individuos.splice(index, 1);
      }
  }
}
function guardarC(){
  // alert(individuos.length);
  //  checkFalse();
  inicioSpinner();

  formulario.append('usuarios', JSON.stringify(individuos));
  // Se hace la petición al servidor
  $.ajax({
     type:'POST',
     url: url+'agregar_usrs',
     data:formulario,
     processData:false,
     contentType:false,
     success:function(result){
       if(result.errores){
         finSpinner();
         mensajeAjax('Error', 'Verifique sus datos', 'error');
         var errores = '<ul>';
         $.each(result.errores,function(indice,valor){
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
       } else{
         mensajeAjax('Registro correcto', result.mensaje,'success');
         checkFalse();
         window.setTimeout(function(){
           location.href = url+'administrar_grupos';
         } ,1500);
       }
      },
      error: function (jqXHR, status, error) {
        finSpinner();
        mensajeAjax('Error', error, 'error');
      }
  });

}
