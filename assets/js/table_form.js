$(function () {

    $('#contatos-form').submit(function (event) {
        event.preventDefault();
        if ($(this)[0].checkValidity()) {
            Save();
        }
    });

    if ($('[name=contatos]').val().length) {
        //[ nome * setor * celular * email ]
        var contatos = $('[name=contatos]').val().split('[');
        var contatos = shift(contatos);
        for (var i = 0; i < contatos.length; i++) {
            var contato = contatos[i];
            if (contato.length) {
                contato = contato.replace(']', '');
                var dadosContato = contato.split(' * ');
                Popula(dadosContato);
            }
        }
    };

    function Popula(values) {
        var tds = '';
        values.forEach(value => tds += `<td>` + value + `</td>`);

        $('#contatos tbody')
            .append(`
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
    };

    function SetInput() {
        var content = '';
        $('#contatos tbody tr').each(function () {
            var par = $(this).closest('tr');
            var tdNome = par.children("td:nth-child(1)");
            var tdSetor = par.children("td:nth-child(2)");
            var tdCelular = par.children("td:nth-child(3)");
            var tdEmail = par.children("td:nth-child(4)");

            content += '[' + tdNome.text() + ' * ' + tdSetor.text() + ' * ' + tdCelular.text() + ' * ' + tdEmail.text() + ']';
        });

        $('[name=contatos]').val(content);
    };

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

        $('input[name=contato_nome]').val(""),
        $('input[name=contato_setor]').val(""),
        $('input[name=contato_celular]').val(""),
        $('input[name=contato_email]').val("")
        $('input[name=contato_nome]').focus("");

        $('#contatos-form').removeClass('was-validated');

        SetInput();
    };
});