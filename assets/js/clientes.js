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

    $('#contatos-form').submit(function(event) {
        event.preventDefault();
        if ($(this)[0].checkValidity()) {
            Save();
        }
    });

    if($('[name=contatos]').val().length) {
        var contatos = $('[name=contatos]').val().split('[');
        for (var i = 0; i < contatos.length; i++) {
            var contato = contatos[i];
            if (contato.length) {
                contato = contato.replace(']', '');
                var dadosContato = contato.split(' * ');
                Popula(dadosContato);
            }
        }
    }

    function Popula(values) {
        var tds = '';
        values.forEach(value => tds += `<td>` + value + `</td>`);

        $('#contatos tbody')
            .prepend(`
                <tr>` + 
                    tds
                    + `<td>
                        <div class="btn-group" role="group" aria-label="Ações">
                            <a href="javascript:void(0)" class="editar-contato btn btn-primary btn-sm">Editar</a>
                            <a href="javascript:void(0)" class="excluir-contato btn btn-secondary btn-sm">Excluir</a>
                        </div>
                    </td>
                </tr>
            `);
        
        $('.editar-contato').bind('click', Edit);
        $('.excluir-contato').bind('click', Delete);
    }

    function SetInput() {
        var content = '';
        $('#contatos tbody tr:not([role=form])').each(function() {
            var par = $(this).closest('tr');
            var tdNome = par.children("td:nth-child(1)");
            var tdSetor = par.children("td:nth-child(2)");
            var tdCelular = par.children("td:nth-child(3)");
            var tdEmail = par.children("td:nth-child(4)");

            content += '[' + tdNome.text() + ' * ' + tdSetor.text() + ' * ' + tdCelular.text() + ' * ' + tdEmail.text() + ']';
        });

        $('[name=contatos]').val(content);
    }

    function Delete() {
        var par = $(this).closest('tr');
        par.remove();
        SetInput();
    };

    function Edit() {
        var par = $(this).closest('tr');
        var tdNome = par.children("td:nth-child(1)");
        var tdSetor = par.children("td:nth-child(2)");
        var tdCelular = par.children("td:nth-child(3)");
        var tdEmail = par.children("td:nth-child(4)");

        $('input[name=contato_nome]').val(tdNome.text())
        $('input[name=contato_setor]').val(tdSetor.text())
        $('input[name=contato_celular]').val(tdCelular.text())
        $('input[name=contato_email]').val(tdEmail.text())

        par.remove();
    };

    function Save() {

        Popula([
            $('input[name=contato_nome]').val(),
            $('input[name=contato_setor]').val(),
            $('input[name=contato_celular]').val(),
            $('input[name=contato_email]').val()
        ]);
            
        $('#contatos-form').removeClass('was-validated');

        $('input[name=contato_nome]').focus();

        SetInput();
    }
});