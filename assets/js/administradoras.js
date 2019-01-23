$(function () {

    $('#form-bandeiras').submit(function (event) {
        event.preventDefault();
        if ($(this)[0].checkValidity()) {
            Save();
        }
    });

    $('.percent-mask').mask('00,00%', { reverse: true });
    $('.number-mask').mask('00');

    $('[name=nroparc]').change(function () {
        $taxas = $('#tabela-taxas');
        if ($(this).val()) {
            $taxas.find('tbody tr').hide()
            $taxas.find('tbody tr').not(':lt(' + $(this).val() + ')').find('input').val(0);
            $('#tabela-taxas').find('tbody tr:lt(' + $(this).val() + ')').show();
            $taxas.show();
        } else {
            $taxas.hide();
        }
    }).change();

    $('#incluir').click(() => Save());

    function Save() {
        Popula([
            $('#iband option:selected').text(),
            $('input[name=contato_setor]').val(),
            $('input[name=contato_celular]').val(),
            $('input[name=contato_email]').val()
        ]);
    };

    function Popula(values) {
        var tds = '';
        values.forEach(value => tds += `<td>` + value + `</td>`);

        $('#table-inclusoes tbody')
            .prepend(`
                <tr>` +
                tds
                + `<td>
                        <div class="btn-group" role="group" aria-label="Ações">
                            <a href="javascript:void(0)" class="editar-inclusao btn btn-primary btn-sm">Editar</a>
                            <a href="javascript:void(0)" class="excluir-inclusao btn btn-secondary btn-sm">Excluir</a>
                        </div>
                    </td>
                </tr>
            `);

        $('.editar-inclusao').bind('click', Edit);
        $('.excluir-inclusao').bind('click', Delete);
    };

    function Edit() {};
    function Delete() {};
});