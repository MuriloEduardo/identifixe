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
    // Campos Únicos
    //
    $.fn.unico = function (params) {

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
                if (json.length > 0) {
                    console.log('success unico ajax', $self)
                    $self.val('');
                    alert(params.mensagem);
                }
            }
        });
    };

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

                if ($(this).val() != '') {
                    $(this).unico({
                        mensagem: 'O email já existe. Tente outro.'
                    });
                }
            }
        });
    };

    //
    // Validação se é Unico com limite minimo de caracteres
    //
    $.fn.validationUniqueMinLength = function (lenght, unico) {
        if ($(this).val() != '') {
            if ($(this).val().length < lenght.min) {
                alert(lenght.mensagem);
                $(this).val('');
            } else {
                $(this).unico({
                    mensagem: unico.mensagem
                });
            }
        }
    };

    //
    // Rg
    //
    $('[name=rg]')
        .mask('0000000000')
        .blur(function () {
            $(this).validationUniqueMinLength({
                min: 10,
                mensagem: 'Preencha o campo no formato: 0000000000'
            }, {
                    mensagem: 'O RG já existe. Tente outro.'
                });
        });

    //
    // Cpf
    //
    $('[name=cpf]')
        .mask('000.000.000-00')
        .blur(function () {
            $(this).validationUniqueMinLength({
                min: 13,
                mensagem: 'Preencha o campo no formato: 000.000.000-00'
            }, {
                    mensagem: 'O CPF já existe. Tente outro.'
                });
        });


    //
    // Cnpj
    //
    $('[name=cnpj]')
        .mask('00.000.000/0000-00')
        .blur(function () {
            $(this).validationUniqueMinLength({
                min: 18,
                mensagem: 'Preencha o campo no formato: 00.000.000/0000-00'
            }, {
                    mensagem: 'O CNPJ já existe. Tente outro.'
                });
        });

    //
    // Telefone
    //
    $('[name=telefone]')
        .mask('(00)0000-0000')
        .blur(function () {
            if ($(this).val() != '') {
                if ($(this).val().length < 13) {
                    alert('Preencha o campo no formato: (00)0000-0000');
                    $(this).val('');
                }
            }
        });

    //
    // Celular
    //
    $('[name=celular]')
        .mask('(00)00000-0000')
        .blur(function () {
            if ($(this).val() != '') {
                if ($(this).val().length < 14) {
                    alert('Preencha o campo no formato: (00)00000-0000');
                    $(this).val('');
                }
            }
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
    // Nome, Nome Fantasia, Razao Social, Fornecedor, Sigla
    //
    $('[name=nome], [name=nome_fantasia], [name=razao_social], [name=fornecedor], [name=sigla]')
        .blur(function () {
            $(this).unico({
                mensagem: 'Esse nome já existe. Tente outro.'
            });
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
        })
        .blur(function () {
            $(this).unico({
                mensagem: 'A sigla já existe. Tente outra.'
            });
        });;

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
                console.log('blur comissao', value)
                if (value == 0) {
                    alert('Comissão precisa ser maior que 0.');
                    $(this).val('');
                }
            }
        });

    //
    // Configurações do DataTable
    //
    $('.dataTable').each(function () {
        $(this).DataTable(
            {
                scrollY: '100vh',
                scrollCollapse: true,
                'scrollX': true,
                responsive: true,
                'language': {
                    'decimal': ',',
                    'thousands': '.',
                    'sEmptyTable': 'Nenhum registro encontrado',
                    'sInfo': 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
                    'sInfoEmpty': 'Mostrando 0 até 0 de 0 registros',
                    'sInfoFiltered': '(Filtrados de _MAX_ registros)',
                    'sInfoPostFix': '',
                    'sInfoThousands': '.',
                    'sLengthMenu': '_MENU_ Resultados por página',
                    'sLoadingRecords': 'Carregando...',
                    'sProcessing': 'Processando...',
                    'sZeroRecords': 'Nenhum registro encontrado',
                    'sSearch': 'Pesquisar',
                    'oPaginate': {
                        'sNext': 'Próximo',
                        'sPrevious': 'Anterior',
                        'sFirst': 'Primeiro',
                        'sLast': 'Último'
                    },
                    'oAria': {
                        'sSortAscending': ': Ordenar colunas de forma ascendente',
                        'sSortDescending': ': Ordenar colunas de forma descendente'
                    }
                },
                'lengthMenu': [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
                'dom': '<l><t><ip>'
            }
        );
    });

    $('#menu-toggle').click(function (e) {
        e.preventDefault();
        $('#wrapper').toggleClass('toggled');
    });

});