$(function () {

    var $inclusoes = $('#inclusoes'),
        $taxa_debito = $('[name=txdebito]'),
        $taxa_credito = $('[name=txcredcom]'),
        $bandeira = $('[name=band]'),
        $dias_debito = $('[name=diasdebito]'),
        $dias_credito = $('[name=diascredcom]'),
        $dias_antecipacao = $('[name=diasantecip]'),
        id_bandeira = '',
        bandeira = '',
        parcelas = '',
        dias_debito = '',
        dias_credito = '',
        dias_antecipacao = '';
    
    $inclusoes.hide();

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

            var $taxasTr = $taxas.find('tbody tr');

            $taxasTr.hide()
            
            $taxasTr.not(':lt(' + $(this).val() + ')').find('input')
                .val(0)
                .removeClass('active');
            
            $taxas
                .find('tbody tr:lt(' + $(this).val() + ')').show()
                .find('.taxas').addClass('active');

            $taxas.show();
        } else {
            $taxas.hide();
        }
    }).change();

    $('#incluir').click(() => Save());

    function Save() {
        
        $inclusoes.show();

        var antecipacoes = '',
            creditos = '';

        $('.taxas-antecipacao.active').each(function(index, el) {
            antecipacoes += `
                <div class="d-flex">
                    <div>` + (index + 1) + `x</div>
                    <span class="px-2">-</span>
                    <div>` + $(el).val() + `</div>
                </div>
            `;
        });
        
        $('.taxas-credito.active').each(function(index, el) {
            creditos += `
                <div class="d-flex">
                    <div>` + (index + 1) + `x</div>
                    <span class="px-2">-</span>
                    <div>` + $(el).val() + `</div>
                </div>
            `;
        });

        id_bandeira = $bandeira.val(),
        bandeira = $('[name=band] option:selected').text(),
        parcelas = $('[name="nroparc"] option:selected').text();
        dias_debito = $dias_debito.val();
        dias_credito = $dias_credito.val();
        dias_antecipacao = $dias_antecipacao.val();

        Popula([
            `
                <div class="id_bandeira">
                    <input type="hidden" value="` + id_bandeira + `">
                    ` + bandeira + `
                </div>
            `,
            parcelas,
            '<div class="d-flex flex-column">' + antecipacoes + '</div>',
            '<div class="d-flex flex-column">' + creditos + '</div>',
            $taxa_debito.val(),
            dias_debito,
            $taxa_credito.val(),
            dias_credito,
            dias_antecipacao
        ]);
    };

    function Popula(values) {

        if($('.id_bandeira input').val() != id_bandeira) {
            var tds = '',
                txcredito = '',
                infos = $taxa_debito.cleanVal() + '-' + dias_debito + '-' + $taxa_credito.cleanVal() + '-' + dias_credito + '-' + dias_antecipacao + '-' + parcelas;
    
            values.forEach(value => tds += '<td>' + value + '</td>');
    
            $('#table-inclusoes tbody')
                .prepend(`
                    <tr>
                        ` + tds + `
                        <td>
                            <div class="btn-group" role="group" aria-label="Ações">
                                <a href="javascript:void(0)" class="editar-inclusao btn btn-primary btn-sm">Editar</a>
                                <a href="javascript:void(0)" class="excluir-inclusao btn btn-secondary btn-sm">Excluir</a>
                            </div>
                        </td>
                    </tr>
                `);
    
            var txantecipacao = $('.taxas-antecipacao').map(function() {
                return $(this).cleanVal();
            }).get().join('-');
            
            var txcredito = $('.taxas-credito').map(function() {
                return $(this).cleanVal();
            }).get().join('-');
    
            $('#main-form').append(`
                <input type="text" data-bandeira="` + id_bandeira + `" name="flag` + id_bandeira + `" value="` + id_bandeira + `" required>
                <input type="text" data-bandeira="` + id_bandeira + `" name="bandeira[` + id_bandeira + `]" value="` + bandeira + `" required>
                <input type="text" data-bandeira="` + id_bandeira + `" name="infos[` + id_bandeira + `]" value="` + infos + `" required>
                <input type="text" data-bandeira="` + id_bandeira + `" name="txant[` + id_bandeira + `]" value="` + txantecipacao + `" required>
                <input type="text" data-bandeira="` + id_bandeira + `" name="txcre[` + id_bandeira + `]" value="` + txcredito + `" required>
            `);

            $('#form-bandeiras').trigger('reset');
            $('[name="nroparc"]').change();
    
            $('.editar-inclusao').bind('click', Edit);
            $('.excluir-inclusao').bind('click', Delete);
        }
    };

    function Edit() {
        var par = $(this).closest('tr'),
            id_bandeira = par.find('.id_bandeira input').val();

        $bandeira.val(id_bandeira);

        var infos = $('[name="infos[' + id_bandeira + ']"]').val().split('-'),
            taxa_debito = infos[0],
            dias_debito = infos[1],
            taxa_credito = infos[2],
            dias_credito = infos[3],
            dias_antecipacao = infos[4],
            parcelas = infos[5];

        $taxa_debito.val(taxa_debito);
        $taxa_debito.trigger('input');

        $dias_debito.val(dias_debito);
        
        $taxa_credito.val(taxa_credito);
        $taxa_credito.trigger('input');

        $dias_credito.val(dias_credito);
        $dias_antecipacao.val(dias_antecipacao);
        
        $('[name="nroparc"]').val(parcelas).change();

        //$(this).siblings('.excluir-inclusao').trigger('click');
    };

    function Delete() {
        var par = $(this).closest('tr'),
            id_bandeira = par.find('.id_bandeira input').val();

        $('[data-bandeira=' + id_bandeira + ']').remove();
        par.remove();
    };
});