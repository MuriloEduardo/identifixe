//
// Campos Únicos
//
$.fn.unico = function () {

    var $self = $(this),
        campo = $self.attr('name');

    console.log('dentro funcao unico');

    $.ajax({
        url: baselink + '/ajax/buscaUnico',
        type: 'POST',
        data: {
            module: currentModule,
            campo: campo,
            valor: $self.val()
        },
        dataType: 'json',
        success: function (json) {
            console.log('sucess', json)
            if (json.length > 0) {
                $self.removeClass('is-valid').addClass('is-invalid');
                $self.after('<div class="invalid-feedback"></div>');
                console.log($self)
            } else {
                $self.removeClass('is-invalid').addClass('is-valid');
            }
        }
    });
};

$('[data-unico="unico"]').blur(function() {
    console.log('unico');
    if ($(this).val()) {
        // $(this).unico();
    } else {
        // $(this).removeClass('is-valid is-invalid');
    }
});