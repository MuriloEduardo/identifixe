$(function () {

    //
    // Escuta o clique dos radios CPF/CPNJ pra mostra e esconder os inputs de CPF/CNPJ
    //
    $('[name=tipo_pessoa]').change(function () {
        if ($(this).is(':checked')) {

            $input = $('[name=cpf_cnpj]');

            if ($(this).attr('id') == 'pj') {
                $input
                    .mask('00.000.000/0000-00')
                    .siblings('label')
                    .find('span')
                    .text('Cnpj');

                $('#contatos-form').show();
            } else {
                $input
                    .mask('000.000.000-00')
                    .siblings('label')
                    .find('span')
                    .text('Cpf');

                $('#contatos-form').hide();
            }
        }
    }).change();

    $('[name=cpf_cnpj]').on('blur', function() {
        if ($(this).val() && $(this).val() != $(this).attr('value')) {
            if ($('[name=tipo_pessoa]:checked').val() == 'pj') {
                $(this).validationMinLength({
                    min: 18,
                    mensagem: 'Preencha o campo no formato: 00.000.000/0000-00'
                });
            } else {
                $(this).validationMinLength({
                    min: 14,
                    mensagem: 'Preencha o campo no formato: 000.000.000-00'
                });
            }
        }
    });
});