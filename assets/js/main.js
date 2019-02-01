$(function () {

    //
    // Validação de Datas
    //
    function validaDat(valor) {
        var date = valor;
        var ardt = new Array;
        var ExpReg = new RegExp('(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}');
        ardt = date.split('/');
        erro = false;
        if (date.search(ExpReg) == -1) {
            erro = true;
        }
        else if (((ardt[1] == 4) || (ardt[1] == 6) || (ardt[1] == 9) || (ardt[1] == 11)) && (ardt[0] > 30))
            erro = true;
        else if (ardt[1] == 2) {
            if ((ardt[0] > 28) && ((ardt[2] % 4) != 0))
                erro = true;
            if ((ardt[0] > 29) && ((ardt[2] % 4) == 0))
                erro = true;
        }
        if (erro) {
            return false;
        }
        return true;
    }

    //
    // Validação Padrão de Email
    //
    $.fn.validaEmail = function () {
        $(this).on('blur', function () {

            if ($(this).val() != '') {

                var email = $(this).val();

                // Retirar espacos em branco do inicio e do final
                email = email.trim();

                if (email.indexOf('@') == -1) {
                    alert('E-mail inválido. Tente outro.')
                    $(this).val('');
                    return;
                } else {
                    if ((email.indexOf('@') >= email.lastIndexOf('.')) || (email.lastIndexOf('.') + 1 >= email.length)) {
                        alert('E-mail inválido. Tente outro.')
                        $(this).val('');
                        return;
                    }
                }
            }
        });
    };

    //
    // Validação com limite minimo de caracteres
    //
    $.fn.validationMinLength = function (params) {
        if ($(this).val() != '') {
            $(this)
                .siblings('.invalid-feedback')
                .remove();
            if ($(this).val().length < params.min) {
                $(this)
                    .removeClass('is-valid')
                    .addClass('is-invalid')
                    .after('<div class="invalid-feedback">' + params.mensagem + '</div>');
            } else {
                $(this)
                    .removeClass('is-invalid')
                    .addClass('is-valid');
            }
        } else {
            $(this)
                .removeClass('is-valid is-invalid');
        }
    };

    //
    // Rg
    //
    $('[name=rg]')
        .mask('0000000000')
        .blur(function () {
            $(this).validationMinLength({
                min: 10,
                mensagem: 'Preencha o campo no formato: 0000000000'
            });
        });

    //
    // Cpf
    //
    $('[name=cpf]')
        .mask('000.000.000-00')
        .blur(function () {
            $(this).validationMinLength({
                min: 14,
                mensagem: 'Preencha o campo no formato: 000.000.000-00'
            });
        });


    //
    // Cnpj
    //
    $('[name=cnpj]')
        .mask('00.000.000/0000-00')
        .blur(function () {
            $(this).validationMinLength({
                min: 18,
                mensagem: 'Preencha o campo no formato: 00.000.000/0000-00'
            });
        });

    //
    // Telefone
    //
    $('[name=telefone]')
        .mask('(00)0000-0000')
        .blur(function () {
            $(this).validationMinLength({
                min: 13,
                mensagem: 'Preencha o campo no formato: (00)0000-0000'
            });
        });

    //
    // Celular
    //
    $('[name=celular]')
        .mask('(00)00000-0000')
        .blur(function () {
            $(this).validationMinLength({
                min: 14,
                mensagem: 'Preencha o campo no formato: (00)00000-0000'
            });
        });

    //
    // Data
    //
    $('[name^=data_]')
        .mask('00/00/0000')
        .datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
        })
        .blur(function () {
            var valor = $(this).val();
            valor = valor.split('/');
            var data = valor[0] + '/' + valor[1] + '/' + valor[2];
            if (valor != '') {
                if (
                    (typeof valor[1] == 'undefined' || typeof valor[2] == 'undefined') ||
                    (valor[2].length > 4 || valor[0].length > 2 || valor[1].length > 2) ||
                    (validaDat(data) == false)
                ) {
                    alert('Data inválida!!!');
                    $(this).val('');
                    return;
                }
            }
        });

    //
    // Sigla
    //
    $('[name=sigla]')
        .mask('ZZZZZ', {
            translation: {
                'Z': {
                    pattern: /[A-Za-z]/
                }
            }
        });

    //
    // Email
    //
    $('[name=email]').validaEmail();

    //
    // Cep
    //
    $('[name=cep]')
        .mask('00000-000')
        .blur(function () {
            if ($(this).val() != '') {
                if ($(this).val().length < 9) {
                    alert('Preencha o campo no formato: 00000-000');
                    $(this).val('');
                } else {
                    $.ajax({
                        url: 'http://api.postmon.com.br/v1/cep/' + $(this).val(),
                        type: 'GET',
                        dataType: 'json',
                        success: function (json) {
                            if (typeof json.logradouro != 'undefined') {
                                $('[name=endereco]').val(json['logradouro']);
                                $('[name=bairro]').val(json['bairro']);
                                $('[name=cidade]').val(json['cidade']);
                                $('[name=numero]').focus();
                            }
                        }
                    });
                }
            }
        });

    //
    // Número
    //
    $('[name=numero]')
        .mask('0#');

    //
    // Salário
    //
    $('[name=salario], [name^=preco], [name=custo]')
        .mask('#.##0,00', {
            reverse: true
        })
        .blur(function () {
            if ($(this).val() != '' && $(this).val() == 0) {
                alert('Salário precisa ser maior que 0.');
                $(this).val('');
            }
        });

    //
    // Comissão, Porcentagen
    //
    $('[name=comissao], [name=porcent]')
        .mask('00,00%', {
            reverse: true
        })
        .blur(function () {
            var value = $(this).val().replace('%', '');
            if (value != '') {
                if (value == 0) {
                    alert('Comissão precisa ser maior que 0.');
                    $(this).val('');
                }
            }
        });

    //
    // Configurações do DataTable
    //
    let dataTable = $('.dataTable').DataTable(
        {
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            conditionalPaging: true,
            autoWidth: false,
            order: [1, 'asc'],
            ajax: {
                url: baselink + '/ajax/dataTableAjax',
                type: 'POST',
                data: {
                    module: currentModule
                }
            },
            language: {
                'decimal': ',',
                'thousands': '.',
                'sEmptyTable': 'Nenhum registro encontrado',
                'sInfo': 'Mostrando de _START_ até _END_ do total de _TOTAL_ registros',
                'sInfoEmpty': 'Mostrando 0 até 0 do total de 0 registros',
                'sInfoFiltered': '(Filtrados de _MAX_ registros)',
                'sInfoPostFix': '',
                'sInfoThousands': '.',
                'sLengthMenu': '_MENU_ Resultados por página',
                'sLoadingRecords': 'Carregando...',
                'sProcessing': 'Processando...',
                'sZeroRecords': 'Nenhum registro encontrado',
                'oPaginate': {
                    'sNext': 'Próximo',
                    'sPrevious': 'Anterior',
                    'sFirst': 'Primeiro',
                    'sLast': 'Último'
                }
            },
            dom: '<t><p><r><i>'
        }
    );

    $('#menu-toggle').click(() => $('#wrapper').toggleClass('toggled'));

    $('[name=searchDataTable]').keyup(function () {
        dataTable.search(this.value).draw();
    });

    $('[data-toggle="tooltip"]').tooltip();
});