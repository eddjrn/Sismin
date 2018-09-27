//function to create cropper on modal dialog
var archivo = false;
$(function () {
  var $image = $('#image');
  var cropBoxData;
  var canvasData;

  $('#photoModalEdit').on('shown.bs.modal', function () {
    $image.cropper({
      autoCropArea: 0.5,
      aspectRatio: 1 / 1,
      viewMode: 0,
      movable: true,
      zoomable: true,
      zoomOnTouch: true,
      zoomOnWheel: true,
      rotatable: true,
      scalable: true,
      center: true,
      minCropBoxWidth: 100,
      minCropBoxHeight: 100,
      checkOrientation: true,

      ready: function () {
        $image.cropper('setCanvasData', canvasData);
        $image.cropper('setCropBoxData', cropBoxData);
        archivo = true;
      }
    });
  });
});

// Import image
var $inputImage = $('#inputImage');
var URL = window.URL || window.webkitURL;
var blobURL;
var $image = $('#image');

if (URL) {
  $inputImage.change(function () {
    var files = this.files;
    var file;

    if (!$image.data('cropper')) {
      return;
    }

    if (files && files.length) {
      file = files[0];

      if (/^image\/\w+$/.test(file.type)) {
        blobURL = URL.createObjectURL(file);
        $image.one('built.cropper', function () {

          // Revoke when load complete
          URL.revokeObjectURL(blobURL);
        }).cropper('reset').cropper('replace', blobURL);
        $inputImage.val('');
      } else {
        notificacionAjax('bg-red', 'Escoja otro archivo', 2500,  'bottom', 'center', null, null);
      }
    }
  });

  $('#registrar').on('click', function(){
    if(archivo){
      $('#image').cropper('getCroppedCanvas', {
        width: 150,
        height: 150,
        fillColor: '#fff',
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'low',
      }).toBlob(function (blob) {
        var formData = new FormData();
        var descripcion = document.getElementById("descripcion").value;
        var admin_grupo = $('#administrador_grupo').val();
        if(admin_grupo == 0){
            notificacionAjax('bg-red','Debes seleccionar un administador para éste grupo', 2500,  'bottom', 'center', null, null);
            return false;
        }
        formData.append('croppedImage', blob);
        formData.append('descripcion', descripcion);
        formData.append('id_usuario', admin_grupo);

        $.ajax(UrlToPostForm, {
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success:function(result){
            if(result.errores){
              mensajeAjax('Error', 'Verifique sus datos', 'error');
              var errores = '<ul>';
              $.each(result.errores,function(indice,valor){
                //console.log(indice + ' - ' + valor);
                errores += '<li>' + valor + '</li>';
              });
              errores += '</ul>';
              notificacionAjax('bg-red', errores, 2500,  'bottom', 'center', null, null);
            } else{
              mensajeAjax('Registro correcto', result.mensaje,'success');
              window.setTimeout(function(){
                location.href = UrlToRedirectPage;
              } ,1500);
            }
           },
           error: function (jqXHR, status, error) {
            mensajeAjax('Error', error, 'error');
           }
        });
      });
    } else{
      notificacionAjax('bg-red', 'Escoja un archivo para el logotipo de la organización', 2500,  'bottom', 'center', null, null);
    }
  });

  $('#rotateRight').on('click', function(){
    $('#image').cropper('rotate', 45);
  });
  $('#rotateLeft').on('click', function(){
    $('#image').cropper('rotate', -45);
  });
  $('#reset').on('click', function(){
    $('#image').cropper('reset');
  });

} else {
  $inputImage.prop('disabled', true).parent().addClass('disabled');
}
//END function to create cropper on modal dialog

// function to change img size on mobiles
function checkPosition() {
    if (window.matchMedia('(max-width: 768px)').matches) {
        $('.img-size').css({
            'height':'150px',
            'width':'auto',
            'margin':'auto',
        });
    } else {
        $('.img-size').css({
            'height':'200px',
            'width':'auto',
            'margin':'auto',
        });
    }
}
//END function to change img size on mobiles

//function to show the SweetAlert
function alerts(opc){
    switch(opc){
        case 1:
            swal({
                title: "Actualizado",
                text: "Se ha cambiado la imagen.",
                type: "success",
                //confirmButtonClass: "btn-success"
                timer: 1500,
                showConfirmButton: false
            });
        break;
        case 2:
            swal({
                title: "¡Error!",
                text: "No se pudo completar la operación.",
                type: "error",
                //confirmButtonClass: "btn-danger"
                timer: 1500,
                showConfirmButton: false
            });
        break;
    }
}
//END function to show the SweetAlert
