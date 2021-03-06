<script>
function mensajeAjax(titulo, mensaje, tipo) {
    // tipo => 'success' , 'waring' o 'error'
    swal({
        title: titulo,
        text: mensaje,
        type: tipo,
        showCancelButton: false,
        showConfirmButton: false,
        timer: 2000,
    });
}

function mensajeAjaxIcono(titulo, mensaje, imagen) {
    // tipo => 'success' , 'waring' o 'error'
    swal({
        title: titulo,
        text: mensaje,
        imageUrl: imagen,
        showCancelButton: false,
        showConfirmButton: false,
        timer: 2000,
    });
}

// colorName => 'bg-red', text => 'texto', time => 1000, placementFrom => 'bottom', placementAlign => 'center'
function notificacionAjax(colorName, text, time,  placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: time,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}
</script>
