function actualizarEstatus(tarea,id){
  $('#estatusModal').modal('show');
  var check = $("#estatus_"+id).is(':checked');
  $('#btnCancelarE').attr('onclick',`checkD(${id})`);
 if(check && (tarea.length!=0)){
        $('#btnAsignarE').attr('onclick',`actualizarE(${id})`);
   }else{
     notificacionAjax('bg-red','No le ha asignado una tarea a éste compromiso ', 2500,  'bottom', 'center', null, null);
   }

}

function checkD(id){
  $('#estatus_'+id).prop("checked", false);
}

function actualizarE(id){
 var f = 1;
  $.ajax({
     type:'POST',
     url: urlE,
     data:
     {
       "id_compromiso_resp":id,
       "realizado":f
     },
     success:function(result){
       if(result.errores){
         var errores = '<ul>';
         $.each(result.errores,function(indice,valor){
           errores += '<li>' + valor + '</li>';
         });
         errores += '</ul>';
         notificacionAjax('bg-red',errores, 2500,  'bottom', 'center', null, null);
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

$(function (){
  $('.treeview').each(function () {
     var tree = $(this);
     tree.treeview();
   });
})
