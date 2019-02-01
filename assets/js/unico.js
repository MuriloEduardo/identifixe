//
// Campos Únicos
//
$.fn.unico = function () {

    var $self = $(this),
        campo = $self.attr('name');

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

            if (!$self.hasClass('is-invalid')) {

                $self
                    .siblings('.invalid-feedback')
                    .remove();

                $self
                    .removeClass('is-invalid')
                    .addClass('is-valid');

                if (json.length > 0) {
                    $self.removeClass('is-valid').addClass('is-invalid');
                    text_label = $self.siblings('label').find('span').text();
                    $self.after('<div class="invalid-feedback">Este ' + text_label.toLowerCase() + ' já está sendo usado</div>');
                }
            }


        }
    });
};

$('[data-unico="unico"]').blur(function () {
    if ($(this).val() && $(this).val() != $(this).attr('value')) {
        $(this).unico();
    } else {
        $(this).removeClass('is-valid is-invalid');
    }
});