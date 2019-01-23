window.onload = function(){
    $('#inroparc').change();
    
    if(typeof bandeirasAceitas !== 'undefined'){
        preenchetabela();
        limparPreenchimento();
    }
};

$(function(){
    $('#inome').on('blur',function(){
        var nome = $(this).val();
        var action = "ConfereNomeAdm";
        if($(this).val() != ''){
            $.ajax({
                url:baselink+"/ajax/"+action,
                type: 'POST',
                data:{q:nome},
                dataType:'json',
                success:function(json){
                    if(json.length > 0){
                       $('#inome').val("");
                       alert("O nome da Admnistradora já existe. Tente outro.");
                    }
                }
            });
        }
    });  
});

function confirmaPreenchimento(){
    //testando o preenchimento das variáveis necessárias para adicionar a lista de bandeiras aceitas
    var ok = true;
    if($('#iband').val() == ""){
       alert("Selecione a bandeira do cartão.");
       $('#iband').focus();
       ok = false;
       return;
    }
    var nomeA = $('#itxdebito').val();
        nomeA = nomeA.replace(",",".");
        nomeA = nomeA.replace("%","");
    var numA = parseFloat(nomeA).toFixed(2);
    if(numA == 0 || $('#itxdebito').val() == "" || $('#itxdebito').val() == "%"){
        $('#itxdebito').focus();
        alert("Digite a Taxa de Débito.");
        ok = false;
        return;
    }
    if($('#idiasdebito').val() == ""){
        alert("Digite a quantidade de dias para receber no Débito.");
        $('#idiasdebito').focus();
        ok = false;
        return;
    }
    var nomeB = $('#itxcredcom').val();
        nomeB = nomeB.replace(",",".");
        nomeB = nomeB.replace("%","");
    var numB = parseFloat(nomeB).toFixed(2);
    if(numB == 0 || $('#itxcredcom').val() == "" || $('#itxcredcom').val() == "%"){
        $('#itxcredcom').focus();
        alert("Digite a Taxa de Crédito com Juros.");
        ok = false;
        return;
    }
    if($('#idiascredcom').val() == ""){
        alert("Digite a quantidade de dias para receber no Crédito com Juros.");
        $('#idiascredcom').focus();
        ok = false;
        return;
    }
    if($('#idiasantecip').val() == ""){
        alert("Digite a quantidade de dias para receber a Antecipação.");
        $('#idiasantecip').focus();
        ok = false;
        return;
    }
    if($('#inroparc').val() == ""){
       alert("Selecione a quantidade máxima de parcelas aceitas.");
       $('#inroparc').focus();
       ok = false;
       return;
    }
    
    var nroparc = $('#inroparc').val();
    var okaqui = true;
    if(nroparc !== ""){
        for(var i=1;i<=12;i++){
            if(i <= nroparc){
                var nome1 = $('#itxantecip_'+i+'').val();
                nome1 = nome1.replace(",",".");
                nome1 = nome1.replace("%","");
                num1 = parseFloat(nome1).toFixed(2);
                
                var nome2 = $('#itxcredsemjuros_'+(12+i)+'').val();
                nome2 = nome2.replace(",",".");
                nome2 = nome2.replace("%","");
                num2 = parseFloat(nome2).toFixed(2);
                
                if(num1 == 0 || $('#itxantecip_'+i+'').val() == "" || $('#itxantecip_'+i+'').val() == "%" ){
                    okaqui = false;
                    $('#itxantecip_'+i+'').focus();
                    return;
                }else if(num2 == 0 || $('#itxcredsemjuros_'+(12+i)+'').val() == "" || $('#itxcredsemjuros_'+(12+i)+'').val() == "%"){
                    okaqui = false;
                    $('#itxcredsemjuros_'+(12+i)+'').focus();
                    return;
                }
            }else{
                if($('#itxantecip_'+i+'').val() != 0 || $('#itxcredsemjuros_'+(12+i)+'').val() != 0 ){
                    okaqui = false;
                }
            }
        }
        if(okaqui == false){
            alert("As taxas dos campos em branco da tabela devem ser diferentes de 0 (zero) e vazio");
            ok = false;
            return;
        }
    }else{
       alert("Selecione a quantidade máxima de parcelas aceitas.");
       ok = false;
       return;
    }
    // termino dos testes de preenchimento dos campos necessários
    
    if(ok !== false){
    //início da inserção da nova linha    
    var band = $('#iband').val(); // id de cadastro da bandeira
    var bandeira = $('#iband option:selected').text(); // nome de cadastro da bandeira
        
    var txdeb = numA;
    var diasdeb = parseInt($('#idiasdebito').val());
    var txcred = numB;
    var diascred = parseInt($('#idiascredcom').val());
    var mdiasantecip = parseInt($('#idiasantecip').val());
    var numparc = parseInt($('#inroparc').val());
    var infos = txdeb+"-"+diasdeb+"-"+txcred+"-"+diascred+"-"+diasantecip+"-"+numparc;
    
    
    for(var i=1;i<=12;i++){
        var nomeA = $('#itxantecip_'+i+'').val();
        nomeA = nomeA.replace(",",".");
        nomeA = nomeA.replace("%","");
        nro1 = parseFloat(nomeA).toFixed(2);

        var nomeB = $('#itxcredsemjuros_'+(12+i)+'').val();
        nomeB = nomeB.replace(",",".");
        nomeB = nomeB.replace("%","");
        nro2 = parseFloat(nomeB).toFixed(2);
        if(i == 1){
           var txantecipacao = nomeA;
           var txcredito = nomeB;
        }else{
            txantecipacao += "-"+nomeA;
            txcredito += "-"+nomeB;
        }
    }                    
    //testar se já tem na tabela a bandeira selecionada
    if($('input[name="flag'+band+'"]').length == 0){ // se a bandeira ainda não foi selecionada
        var linha = "<tr>";
        linha += "<td>"+"<input type='text' name='flag"+band+"' class='input-table-selec'  value='"+bandeira+"' readonly='readonly' required/>"+
                        "<input type='hidden' name='bandeira["+band+"]' value='"+band+"' required/>"                                                   +"</td>";
        linha += "<td class='colTabela'>"+"<input type='text' name='infos["+band+"]' class='input-table-selec'  value='"+infos+"'         readonly='readonly' required/>"+"</td>";
        linha += "<td class='colTabela'>"+"<input type='text' name='txant["+band+"]' class='input-table-selec'  value='"+txantecipacao+"' readonly='readonly' required/>"+"</td>";
        linha += "<td class='colTabela'>"+"<input type='text' name='txcre["+band+"]' class='input-table-selec'  value='"+txcredito+"'     readonly='readonly' required/>"+"</td>";
        linha += "<td>"+"<a href='#' class='botao_peq_adm' onclick='editar(this)'>Editar</a>"+"<a href='#' class='botao_peq_adm' onclick='excluir(this)'>Excluir</a>"+"</td>";
        linha += "</tr>"

        $('#tabelaenvio').append(linha);
        limparPreenchimento();
        
    }else{//se a bandeira já existe na tabela - perguntar se quer editar as informações (sobrescrever)
        if(confirm('A bandeira já existe na tabela, deseja sobrescrever as informações?')){
            $('input[name="flag'+band+'"]').closest('tr').children('td:eq(1)').children('input:eq(0)').attr('value',infos);
            $('input[name="flag'+band+'"]').closest('tr').children('td:eq(2)').children('input:eq(0)').attr('value',txantecipacao);
            $('input[name="flag'+band+'"]').closest('tr').children('td:eq(3)').children('input:eq(0)').attr('value',txcredito);
            limparPreenchimento();
            
        }
    }    
    }else{
        alert("Todos os campos acima devem estar preenchidos!");
    }
    
}   

function excluir(obj){
    $(obj).closest('tr').remove();
    limparPreenchimento();
    
}

function editar(obj){
    limparPreenchimento();
    var idband = $(obj).closest('tr').children('td:eq(0)').children('input:eq(1)').attr('value');
    var informs = $(obj).closest('tr').children('td:eq(1)').children('input:eq(0)').attr('value');
    var infos = informs.split("-");
    
    var txantecip = $(obj).closest('tr').children('td:eq(2)').children('input:eq(0)').attr('value');
    var txant = txantecip.split("-");
    
    var txcredito = $(obj).closest('tr').children('td:eq(3)').children('input:eq(0)').attr('value');
    var txcred = txcredito.split("-");
    
    $('#iband').val(idband);
    $('#itxdebito').val(infos[0].replace(".",",")+"%");
    $('#idiasdebito').val(infos[1]);
    $('#itxcredcom').val(infos[2].replace(".",",")+"%");
    $('#idiascredcom').val(infos[3]);
    $('#idiasantecip').val(infos[4]);
    $('#inroparc').val(infos[5]);
    $('#inroparc').change();
    
    for(var i=1; i <= infos[5]; i++){
        $('#itxantecip_'+i).val(txant[i-1].replace(".",",")+"%");
        $('#itxcredsemjuros_'+(12+i)).val(txcred[i-1].replace(".",",")+"%");
    } 
}

function preenchetabela(){
    for(var i=0; i< bandeirasAceitas.length; i++){
  
        var band = bandeirasAceitas[i].id; //acho que posso colocar bandeirasAceitas[i].id e trocar somente a flag
        var infos = bandeirasAceitas[i].informacoes;
        var txantecipacao = bandeirasAceitas[i].txantecipacao;
        var txcredito = bandeirasAceitas[i].txcredito;
        var nomeband = bandeirasAceitas[i].nome;
        $('#iband').val(bandeirasAceitas[i].nome);
        var bandeira = $('#iband :selected').text();
        
        if($('input[name="flag'+band+'"]').length == 0){ // se a bandeira ainda não foi selecionada
            var linha = "<tr>";
            linha += "<td>"+"<input type='text' name='flag"+nomeband+"' class='input-table-selec'  value='"+bandeira+"' readonly='readonly' required/>"+
                            "<input type='hidden' name='bandeira["+band+"]' value='"+nomeband+"' required/>"                                                   +"</td>";
            linha += "<td class='colTabela'>"+"<input type='text' name='infos["+band+"]' class='input-table-selec'  value='"+infos+"'         readonly='readonly' required/>"+"</td>";
            linha += "<td class='colTabela'>"+"<input type='text' name='txant["+band+"]' class='input-table-selec'  value='"+txantecipacao+"' readonly='readonly' required/>"+"</td>";
            linha += "<td class='colTabela'>"+"<input type='text' name='txcre["+band+"]' class='input-table-selec'  value='"+txcredito+"'     readonly='readonly' required/>"+"</td>";
            linha += "<td>"+"<a href='#' class='botao_peq_adm' onclick='editar(this)'>Editar</a>"+"<a href='#' class='botao_peq_adm' onclick='excluir(this)'>Excluir</a>"+"</td>";
            linha += "</tr>"

            $('#tabelaenvio').append(linha);
            limparPreenchimento();
        }
    }
    limparPreenchimento();
}

function testeEnvio(){
    if($('#tabelaenvio tbody tr').length > 0){
       if(confirm("Tem Certeza?")){
            return true;
        }else{
            return false;
        }
    }else{
        alert("É necessária, no mínimo, configurar uma bandeira.");
        return false;
    }
    
    
}