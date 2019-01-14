window.onload = function(){

    if(typeof (valoresCliente) !== "undefined"){
        
        if(valoresCliente[0][15] != ''){
           var contatos = valoresCliente[0][15];
               contatos = contatos.split("]");
               
            //ADICIONA UM NOVO CONTATO
            var ctnaux;
            var nome;
            var setor;
            var celular;
            var email;         
            var linha;
            
            if(contatos.length > 0){
                for(var i = 0; i < contatos.length - 1; i++){
                    ctnaux = contatos[i].trim();
                    ctnaux = ctnaux.split("*");
                    
                    nome    = ctnaux[0].replace("[","");
                    nome    = nome.trim();
                    setor   = ctnaux[1];
                    celular = ctnaux[2];
                    email   = ctnaux[3];
                    
                    linha = "<div class='input-pai'>"+
                                "<div class='input-filho'>"+
                                    "<input type='text'  class='input-block' readonly='readonly' id="+(i+1)+" name='contatos["+i+"]'"+
                                    " value = '["+nome+" * "+setor+" * "+celular+" * "+email+"]' />"+
                                "</div>"+
                                "<div class='input-filho'>"+
                                    "<div class='botao_peq_cl1' onclick='editaContato(this)'> Edt </div>"+       
                                    "<div class='botao_peq_cl1' onclick='excluiContato(this)'> Exc </div>"+
                                "</div>"+
                            "</div>";
                        
                    $('#iconts').append(linha);       
                }  
            }
            $("#ipj").prop('checked','checked');
            // $("#itxt2").mask('00.000.000/0000-00', {reverse: true});
            $("#itxt2").attr('placeholder','CNPJ');
            $('#icontatos').show();  
            
        }else{
            if(valoresCliente[0][3] != ''){
                var val = valoresCliente[0][3];
                    if(val.length < 17 ){
                        $("#ipf").prop('checked','checked');
                        // $("#itxt2").mask('000.000.000-00', {reverse: true});
                        $("#itxt2").attr('placeholder','CPF');
                        $('#icontatos').hide();           
                    }else{
                        $("#ipj").prop('checked','checked');
                        // $("#itxt2").mask('00.000.000/0000-00', {reverse: true});
                        $("#itxt2").attr('placeholder','CNPJ');
                        excluiTodosContatos();
                        $('#icontatos').show();
                    }    
            }else{ // não tem contatos nem cnpj --> é pf
                $("#ipf").prop('checked','checked');
                // $("#itxt2").mask('000.000.000-00', {reverse: true});
                $("#itxt2").attr('placeholder','CPF');
                $('#icontatos').hide(); 
            }
        }           
    }else{// inicialização do form se for a página de adicionar
        // $("#itxt2").mask('000.000.000-00', {reverse: true});
        $("#itxt2").attr('placeholder','CPF');
        $('#icontatos').hide();     
    }   

};

function filterColumn ( i ) {
    
    if(i != ''){
       $('#tabelaclientes').DataTable().column( i ).search(
            $('#ifiltro').val()
        ).draw();
    }else{
        $('#tabelaclientes').DataTable().search(
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
    
    // coloca as máscaras nos inputs e testes
    $('#itxt1').on('blur',function(){
        if($("#itxt1").val() != ""){
            var nome = $(this).val();
            var action = "ConfereNomeCliente";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt1').val("");
                           alert("O Nome do Cliente já existe. Tente outro.");
                        }
                    }
                });
            }
        }
    });
    
    $("#ipf").on('click change',function(){
        limparPreenchimento();
        
        if($("#ipf").is(':checked')){
            $("#itxt2").mask('000.000.000-00', {reverse: true});
            $("#itxt2").attr('placeholder','CPF');
            
            excluiTodosContatos();
            $('#icontatos').slideUp('slow');
        }else{
            $("#itxt2").mask('00.000.000/0000-00', {reverse: true});
            $("#itxt2").attr('placeholder','CNPJ');
            
            excluiTodosContatos();
            $('#icontatos').slideDown('slow');
        }
    });
    $("#ipj").on('click change',function(){
        $("#ipf").change();
    });
   
    
    // $('#itxt2').on('blur',function(){
    //     if($("#itxt2").val() != ""){
    //         if($("#ipf").is(':checked') && $("#itxt2").val().length < 14){
    //             alert("Preencha o campo no formato: '000.000.000-00'");
    //             $("#itxt2").val("");
    //         }else if($("#ipj").is(':checked') && $("#itxt2").val().length < 18){
    //             alert("Preencha o campo no formato: '00.000.000/0000-00'");
    //             $("#itxt2").val("");
    //         }else{
            
    //             var nome = $(this).val();
    //             var action = "ConfereCpfCliente";
    //             if($(this).val() != ''){
    //                 $.ajax({
    //                     url:baselink+"/ajax/"+action,
    //                     type: 'POST',
    //                     data:{q:nome},
    //                     dataType:'json',
    //                     success:function(json){
    //                         if(json.length > 0){
    //                            if($("#ipf").is(':checked')){
    //                                 $('#itxt2').val("");
    //                                 alert("O CPF já existe. Tente outro.");
    //                             }else{
    //                                 $('#itxt2').val("");
    //                                 alert("O CNPJ já existe. Tente outro.");
    //                             }   
    //                         }
    //                     }
    //                 });
    //             }
    //         }
    //     }    
    // });
    
    $('#itxt3').mask('(00)00000-0000');
    $("#itxt3").blur(function(){
        if($("#itxt3").val() != ""){
            if($("#itxt3").val().length < 14){
                alert("Preencha o campo no formato: (00)00000-0000");
                $("#itxt3").val("");
            }
        }    
    });
    
    $('#itxt5').mask('(00)0000-0000');
    $("#itxt5").blur(function(){
        if($("#itxt5").val() != ""){
            if($("#itxt5").val().length < 13){
                alert("Preencha o campo no formato: (00)0000-0000");
                $("#itxt5").val("");
            }
        }    
    });
        
    $("#itxt7").mask('00000-000', {reverse: true});
    $("#itxt7").blur(function(){
        if($("#itxt7").val() != ""){
            if($("#itxt7").val().length < 8){
                alert("Preencha o campo no formato: 00000-000");
                $("#itxt7").val("");
            }else{
                var cep = $(this).val();

                $.ajax({
    //url:'https://viacep.com.br/ws/'+cep+'/json/', //https://viacep.com.br/ws/{siglaUF}/{nomeCidade}/{nomeRua OU pedaço nomeRua}/json/  ---  para consultar cep pelo endereço
                    url:'http://api.postmon.com.br/v1/cep/'+cep, 
                    type:'GET',
                    dataType:'json',
                    success:function(json){
                        if(typeof json.logradouro != 'undefined'){
                            $('#itxt8').val(json['logradouro']); //endereço
                            $('#itxt11').val(json['bairro']); //bairro
                            $('#itxt12').val(json['cidade']); //cidade
                            $('#itxt9').focus();
                        }
                    },
                    error:function(){

                    }
                });
            }    
        }
    });
    
    $("#itxt9").mask('0000000');
    
    $('#inome, #isetor, #iemail').keypress(function (e) { // elimina o * da digitação
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 42) ? false : true;
    });
    
    $('input').keypress(function (e) { // elimina o * da digitação
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
    });
   
    $('#icel').mask('(00)00000-0000');
    $("#icel").blur(function(){
        if($("#icel").val() != ""){
            if($("#icel").val().length < 14){
                alert("Preencha o campo no formato: (00)00000-0000");
                $("#icel").val("");
            }
        }    
    });
    
});

function excluiTodosContatos(){
    limpaAux();
    if($('#iconts div.input-pai').length > 1){
       for(var i = 1; i < $('#iconts div.input-pai').length; i++){
           $('#iconts div.input-pai:eq('+i+')').remove();
       } 
    }
    $("#itxt14").val($("#itxt14").attr('data-ant'));
}

function limpaAux(){
    $("#inome").val("");
    $("#inome").attr("data-ident","");
    $("#isetor").val("");
    $("#icel").val("");
    $("#iemail").val("");
}

function adicionaContato(){
    if($("#inome").val() == ''){
        alert("Preencha o nome do Contato.");
        return;
    }else if($("#icel").val() == '' && $("#iemail").val() == ''){
        alert("Preencha pelo menos um dos campos Celular ou Email.");
        return;
    }else{
        if($("#inome").attr('data-ident') == ''){
            //ADICIONA UM NOVO CONTATO
            var idmax = 0;
            var idaux = 0;
            var nroArray = 0;
            
            if($('#iconts input').length > 4){
                for(var i = 4; i < $('#iconts input').length; i++){
                    idaux = parseInt($('#iconts input:eq('+i+')').attr('id'));
                    if(idaux > idmax){
                        idmax = idaux;
                    }
                }
            }

            var nome = $("#inome").val().trim();
            var setor = $("#isetor").val().trim();
            var celular = $("#icel").val().trim();
            var email = $("#iemail").val().trim();
            if(idmax > 0){
                nroArray = parseInt($('#iconts input').length - 4);
            }    

            var linha = "<div class='input-pai'>"+
                            "<div class='input-filho'>"+
                                "<input type='text'  class='input-block' readonly='readonly' id="+(idmax+1)+" name='contatos["+nroArray+"]'"+
                                " value = '[ "+nome+" * "+setor+" * "+celular+" * "+email+" ]' />"+
                            "</div>"+
                            "<div class='input-filho'>"+
                                "<div class='botao_peq_cl1' onclick='editaContato(this)'> Edt </div>"+       
                                "<div class='botao_peq_cl1' onclick='excluiContato(this)'> Exc </div>"+
                            "</div>"+
                        "</div>";
            
            $('#iconts').append(linha);

        }else{
            //EDITA UM CONTATO EXISTENTE
            var idalter = $("#inome").attr('data-ident');
            
            if($('#iconts input').length > 4){
                for(var i = 4; i < $('#iconts input').length; i++){
                    if($('#iconts input:eq('+i+')').attr('id') == $("#inome").attr('data-ident')){
                        var nome = $("#inome").val().trim();
                        var setor = $("#isetor").val().trim();
                        var celular = $("#icel").val().trim();
                        var email = $("#iemail").val().trim();
                        
                        $('#iconts input:eq('+i+')').val("[ "+nome+" * "+setor+" * "+celular+" * "+email+" ]");
                        
                    }
                }
            }
        }
        
        limpaAux();
        atualizaContatos();
    }
}

function editaContato(obj){
    limpaAux();
    
    var conteudo = $(obj).closest('.input-pai').children('.input-filho').children('input').val();
        conteudo = conteudo.split('*');
    
    var ident = $(obj).closest('.input-pai').children('.input-filho').children('input').attr('id');
    
    $("#inome").val(conteudo[0].trim().replace("[",""));
    $("#inome").attr("data-ident",ident);
    $("#isetor").val(conteudo[1].trim());
    $("#icel").val(conteudo[2].trim());
    $("#iemail").val(conteudo[3].trim().replace("]",""));
    
}

function excluiContato(obj){
    $(obj).closest('.input-pai').remove();
    limpaAux();
    atualizaContatos();
}

function atualizaContatos(){
    var contatos = "";
    if($('#iconts input').length > 4){
        for(var i = 4; i < $('#iconts input').length; i++){
            contatos += $('#iconts input:eq('+i+')').val();
        }
    }
    $('#itxt14').val(contatos);
}

function validaDat(valor){
	var date=valor;
	var ardt=new Array;
	var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
	ardt=date.split("/");
	erro=false;
	if ( date.search(ExpReg)==-1){
		erro = true;
		}
	else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
		erro = true;
	else if ( ardt[1]==2) {
		if ((ardt[0]>28)&&((ardt[2]%4)!=0))
			erro = true;
		if ((ardt[0]>29)&&((ardt[2]%4)==0))
			erro = true;
	}
	if (erro) {
		return false;
	}
	return true;
}

function limparPreenchimento(){
     
    for (var i = 1; i<= 14; i++){
        $('#itxt'+i+'').val("");   
    }

}

function testeEnvio(){
    //event.preventDefault();
    
    var alters = '';
        
    for (var i = 1; i <= 14; i++){
        switch (i) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
                if($('#itxt'+i+'').val() == "" && $('#itxt'+i+'').attr('required') == "required" ){ 
                    alert("Preencha o campo: "+$('#itxt'+i+'').attr('placeholder'));
                    return;
                }else{
                    if($('#itxt'+i+'').val().toUpperCase().trim() != $('#itxt'+i+'').attr('data-ant').toUpperCase().trim() ){
                       alters = alters + '[ '+$('#itxt'+i+'').attr('placeholder').toUpperCase()+': de ( ' + $('#itxt'+i+'').attr('data-ant') + ' ) para ( ' + $('#itxt'+i+'').val() + ' )]'; 
                    }
                } 
        }      
    }
    
    
    if(alters != ""){
        $("#itxt16").val(alters);
//        if(confirm("Deseja editar o Item?") ==  true){
//            return true;
//        }else{
//            return false;
//        }
        if($("#ipj").is(":checked") == true ){
            if($("#itxt2").val() == "" && $('#iconts input').length < 5){
                alert("Preencha o valor do CNPJ ou algum contato da empresa.");
                return false;
            }else{
                if(confirm("Deseja adicionar o Item?") ==  true){
                    return true;
                }else{
                    return false;
                }  
            }
        }else{
            if(confirm("Deseja adicionar o Item?") ==  true){
                return true;
            }else{
                return false;
            }  
        }   
    }else{
        alert("Não foram feitas Edições. Tente Novamente.");
        return false;    
    }        
    
}

function testeEnvio1(){
    if($("#ipj").is(":checked") == true ){
        if($("#itxt2").val() == "" && $('#iconts input').length < 5){
            alert("Preencha o valor do CNPJ ou algum contato da empresa.");
            return false;
        }else{
            if(confirm("Deseja adicionar o Item?") ==  true){
                return true;
            }else{
                return false;
            }  
        }
    }else{
        if(confirm("Deseja adicionar o Item?") ==  true){
            return true;
        }else{
            return false;
        }  
    }   
    
       
    
}