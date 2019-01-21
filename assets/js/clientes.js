$(function () {

    //
    // Escuta o clique dos radios CPF/CPNJ pra mostra e esconder
    // os inputs de CPF/CNPJ
    //
    $('[name=tipo_pessoa]').on('change ready', function () {
        if ($(this).is(':checked')) {

            $self = $(this);

            $el = $('[name=cpf_cnpj]');
            $el.val('');

            if ($(this).attr('id') == 'pj') {
                $el.mask('00.000.000/0000-00');
            } else {
                $el.mask('000.000.000-00');
            }

            $el.on('blur', function () {
                if ($self.attr('id') == 'pj') {
                    $(this).validationUniqueMinLength({
                        min: 18,
                        mensagem: 'Preencha o campo no formato: 00.000.000/0000-00'
                    }, {
                            mensagem: 'O CNPJ já existe. Tente outro.'
                        });
                } else {
                    $(this).validationUniqueMinLength({
                        min: 13,
                        mensagem: 'Preencha o campo no formato: 000.000.000-00'
                    }, {
                            mensagem: 'O CPF já existe. Tente outro.'
                        });
                }
            });
        }
    }).change();

    $cntNome = $('[name=contato_name]');
    $cntSetor = $('[name=contato_setor]');
    $cntCelular = $('[name=contato_celular]');
    $cntEmail = $('[name=contato_email]');

    $('#contatos #incluir').click(function () {
        $('#contatos tbody').prepend(`
            <tr>
                <td>` + $cntNome.val() + `</td>
                <td>` + $cntSetor.val() + `</td>
                <td>` + $cntCelular.val() + `</td>
                <td>` + $cntEmail.val() + `</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <a href="javascript:void(0)" class="editar-contato btn btn-primary btn-sm">Editar</a>
                        <a href="javascript:void(0)" class="excluir-contato btn btn-secondary btn-sm">Excluir</a>
                    </div>
                </td>
            </tr>
        `);
    });

    $('.editar_contato').click(function() {
        $cntNome.val('');
        $cntSetor.val('');
        $cntEmail.val('');
        $cntCelular.val('');
    });
});