 
function filterColumn ( i ) {
    
    if(i != ''){
       $('#tabelafornecedores').DataTable().column( i ).search(
            $('#ifiltro').val()
        ).draw();
    }else{
        $('#tabelafornecedores').DataTable().search(
            $('#ifiltro').val()
        ).draw(); 
    }
}

$(document).ready(function () {
    
    $('#ifiltro').on('keyup change' ,function(){
        filterColumn( $('#icampo').val() );
    });
    
    
    $('#icampo').on('focus',function(){             
        if($('#ifiltro').val() != ""){
          $('#ifiltro').val("");  
          $('#ifiltro').change();  
        }
    });
    
    $('#tabelafornecedores').DataTable( 
        {
            scrollY: '100vh',
            scrollCollapse: true,
            "scrollX": true,
            
            responsive:true,
            
            "language": {
                "decimal": ",",
                "thousands": ".",
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
        
            "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
            
            "dom": '<l><t><ip>'
        }
        
    );

    
    // coloca as máscaras nos inputs e testes
    $('#itxt1').on('blur',function(){
        if($("#itxt1").val() != ""){
            var nome = $(this).val();
            var action = "ConfereNomeFantasia";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt1').val("");
                           alert("O Nome Fantasia já existe. Tente outro.");
                        }
                    }
                });
            }
        }
    });
    
    $("#itxt2").mask('ZZZZZ', {translation: {'Z': {pattern: /[A-Za-z]/}}});
    $("#itxt2").keyup(function(){
        var a = $("#itxt2").val();
        a = a.toUpperCase();
        $("#itxt2").val(a);
    });
    $('#itxt2').on('blur',function(){
        if($("#itxt2").val() != ""){
            var nome = $(this).val();
            var action = "ConfereSigla";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt2').val("");
                           alert("A sigla já existe. Tente outra.");
                        }
                    }
                });
            }
        }
    });
    $('#itxt3').on('blur',function(){
        if($("#itxt3").val() != ""){
            var nome = $(this).val();
            var action = "ConfereRazao";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt3').val("");
                           alert("A Razão Social já existe. Tente outra.");
                        }
                    }
                });
            }
        }
    });
    
    
    $("#itxt4").mask('00.000.000/0000-00', {reverse: true});
    $("#itxt4").blur(function(){
        if($("#itxt4").val() != ""){
            if($("#itxt4").val().length < 18){
                alert("Preencha o campo no formato: 00.000.000/0000-00");
                $("#itxt4").val("");
            }
            
            var nome = $(this).val();
            var action = "ConfereCnpj";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt4').val("");
                           alert("O CNPJ já existe. Tente outro.");
                        }
                    }
                });
            }
        }    
    });
    
    $("#itxt5").mask('00000-000', {reverse: true});
    $("#itxt5").blur(function(){
        if($("#itxt5").val() != ""){
            if($("#itxt5").val().length < 8){
                alert("Preencha o campo no formato: 00000-000");
                $("#itxt5").val("");
            }else{
                var cep = $(this).val();

                $.ajax({
    //url:'https://viacep.com.br/ws/'+cep+'/json/', //https://viacep.com.br/ws/{siglaUF}/{nomeCidade}/{nomeRua OU pedaço nomeRua}/json/  ---  para consultar cep pelo endereço
                    url:'http://api.postmon.com.br/v1/cep/'+cep, 
                    type:'GET',
                    dataType:'json',
                    success:function(json){
                        if(typeof json.logradouro != 'undefined'){
                            console.log(json);
                            $('#itxt6').val(json['logradouro']); //endereço
                            $('#itxt9').val(json['bairro']); //bairro
                            $('#itxt10').val(json['cidade']); //cidade
                            $('#itxt7').focus();
                        }
                    },
                    error:function(){

                    }
                });
            }    
        }
    });
    
    $("#itxt7").mask('0000000');
    
    $('#itxt11').mask('(00)0000-0000');
    $("#itxt11").blur(function(){
        if($("#itxt11").val() != ""){
            if($("#itxt11").val().length < 13){
                alert("Preencha o campo no formato: (00)0000-0000");
                $("#itxt11").val("");
            }
        }    
    });
    $('#itxt12').mask('(00)00000-0000');
    $("#itxt12").blur(function(){
        if($("#itxt12").val() != ""){
            if($("#itxt12").val().length < 14){
                alert("Preencha o campo no formato: (00)00000-0000");
                $("#itxt12").val("");
            }
        }    
    });

    //validação do nro de pedido(se existe e se está em aberto)
    //verificar o favorecido do lançamento (cliente e/ou fornecedor)
    
});

function limparPreenchimento(){
     
      
    $("#itxt1").val("");
    $("#itxt2").val("");
    $("#itxt3").val("");
    $("#itxt4").val("");
    $("#itxt5").val("");
    $("#itxt6").val("");
    $("#itxt7").val("");
    $("#itxt8").val("");
    $("#itxt9").val("");
    $("#itxt10").val("");
    $("#itxt11").val("");
    $("#itxt12").val("");
    $("#itxt13").val("");
    $("#itxt14").val("");
    $("#itxt15").val("");

}

function testeEnvio(){
    if($('#itxt1').val() == ""){
       alert("Preencha o campo: "+$('#itxt1').attr('placeholder'));
       return;
    }
    if($('#itxt2').val() == ""){
       alert("Preencha o campo: "+$('#itxt2').attr('placeholder'));
       return;
    }
    if($('#itxt3').val() == ""){
       alert("Preencha o campo: "+$('#itxt3').attr('placeholder'));
       return;
    }
    
    if(confirm('Tem Certeza?') == true){
         return true;
     }else{
         return false;
     }
}

