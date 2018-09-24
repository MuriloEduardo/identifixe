window.onload = function(){
    
  if(typeof (valoresfunc) !== "undefined"){
   
    if(valoresfunc[0][17].indexOf('.') == -1){
         $('#itxt16').val(valoresfunc[0][17]+",00"); 
    }else{
        $('#itxt16').val(valoresfunc[0][17].replace(".",",")); 
    } 
    
    if((valoresfunc[0][18].indexOf(".") != -1) && (valoresfunc[0][18].length - (valoresfunc[0][18].indexOf(".")+1)) == 1) {
        $('#itxt17').val(valoresfunc[0][18].replace(".",",")+"0%"); 
    }else{
        $('#itxt17').val(valoresfunc[0][18].replace(".",",")+"%"); 
    }  
//    if(valoresfunc[0][18].length) {
//        $('#itxt17').val(valoresfunc[0][18].replace(".",",")+"0%"); 
//    }else{
//        $('#itxt17').val(valoresfunc[0][18].replace(".",",")+"%"); 
//    }        
   
    if(valoresfunc[0][19].indexOf('.') == -1){
         $('#itxt18').val(valoresfunc[0][19]+",00"); 
    }else{
        $('#itxt18').val(valoresfunc[0][19].replace(".",",")); 
    } 
    
    if(valoresfunc[0][20].indexOf('.') == -1){
         $('#itxt19').val(valoresfunc[0][20]+",00"); 
    }else{
        $('#itxt19').val(valoresfunc[0][20].replace(".",",")); 
    } 
  }
    
};

function filterColumn ( i ) {
    
    if(i != ''){
       $('#tabelafuncionarios').DataTable().column( i ).search(
            $('#ifiltro').val()
        ).draw();
    }else{
        $('#tabelafuncionarios').DataTable().search(
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
    
    $('#tabelafuncionarios').DataTable( 
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
            var action = "ConfereNomeFuncionario";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt1').val("");
                           alert("O Nome do Funcionário já existe. Tente outro.");
                        }
                    }
                });
            }
        }
    });
    
    $('#itxt2').on('blur',function(){
        if($("#itxt2").val() != ""){
            var email = $(this).val();
                email = email.trim();
            if(email.indexOf("@") == -1){
                alert("E-mail inválido. Tente outro.")
                $("#itxt2").val("");
                return;
            }else{
                if((email.indexOf("@") >= email.lastIndexOf(".")) || (email.lastIndexOf(".")+1 >= email.length )){
                    alert("E-mail inválido. Tente outro.")
                    $("#itxt2").val("");
                    return;
                }
            }
            
            var nome = $(this).val();
            var action = "ConfereEmailFuncionario";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt2').val("");
                           alert("O email já existe. Tente outro.");
                        }
                    }
                });
            }
        }
    });
    
    $("#itxt3").mask('000.000.000-00', {reverse: true});
    $('#itxt3').on('blur',function(){
        if($("#itxt3").val() != ""){
            var nome = $(this).val();
            var action = "ConfereCpfFuncionario";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt3').val("");
                           alert("O CPF já existe. Tente outro.");
                        }
                    }
                });
            }
        }
    });
     
    $("#itxt4").mask('00000-000', {reverse: true});
    $("#itxt4").blur(function(){
        if($("#itxt4").val() != ""){
            if($("#itxt4").val().length < 8){
                alert("Preencha o campo no formato: 00000-000");
                $("#itxt4").val("");
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
                            $('#itxt5').val(json['logradouro']); //endereço
                            $('#itxt8').val(json['bairro']); //bairro
                            $('#itxt9').val(json['cidade']); //cidade
                            $('#itxt6').focus();
                        }
                    },
                    error:function(){

                    }
                });
            }    
        }
    });
    
    $("#itxt6").mask('0000000');
    
    $('#itxt10').mask('(00)0000-0000');
    $("#itxt10").blur(function(){
        if($("#itxt10").val() != ""){
            if($("#itxt10").val().length < 13){
                alert("Preencha o campo no formato: (00)0000-0000");
                $("#itxt10").val("");
            }
        }    
    });
    $('#itxt11').mask('(00)00000-0000');
    $("#itxt11").blur(function(){
        if($("#itxt11").val() != ""){
            if($("#itxt11").val().length < 14){
                alert("Preencha o campo no formato: (00)00000-0000");
                $("#itxt11").val("");
            }
        }    
    });
    
    $("#itxt12").blur(function(){
        var valor = $("#itxt12").val();
            valor = valor.split("-");
        var data = valor[2]+"/"+valor[1]+"/"+valor[0];
        if(valor != ""){
            if(valor[0].length > 4 ){
                $("#itxt12").val("");
                $("#itxt12").blur();
                alert("não é uma data válida!!!");
            }
            if(validaDat(data) == false){
                $("#itxt12").val("");
                alert("não é uma data válida!!!");
                $("#itxt12").blur();
            }
        }
    });
    
    $("#itxt14").blur(function(){
        $("#itxt13").val($("#itxt14 :selected").html());         
    });
    
    $('#itxt16').mask("#.##0,00", {reverse: true});
    $('#itxt17').mask("00,00%", {reverse: true});
    $('#itxt18').mask("#.##0,00", {reverse: true});
    $('#itxt19').mask("#.##0,00", {reverse: true});
    
    $("#senha1").blur(function(){
        if($("#senha1").val() != ""){
            var senha = $('#senha1').val();
            if( senha.length <= 6 ){
                    alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                    $('#senha1').val("");
                    return;
            }else{
                if($.isNumeric(senha) == true){
                    alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                    $('#senha1').val("");
                    return;
                }else{
                    var ok = false;
                    for(var i =0; i< senha.length; i++){
                        if( $.isNumeric(senha.charAt(i)) ){
                            ok = true;
                        }
                    }
                    if(ok == false){
                       alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#senha1').val("");
                        return; 
                    }
                }
            }
        }
    });
    $("#itxt20").blur(function(){
        if($("#itxt20").val() != ""){
            if($("#itxt20").val() != ""){
                var senha = $('#itxt20').val();
                if( senha.length <= 6 ){
                        alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#itxt20').val("");
                        return;
                }else{
                    if($.isNumeric(senha) == true){
                        alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#itxt20').val("");
                        return;
                    }else{
                        var ok = false;
                        for(var i =0; i< senha.length; i++){
                            if( $.isNumeric(senha.charAt(i)) ){
                                ok = true;
                            }
                        }
                        if(ok == false){
                           alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                            $('#itxt20').val("");
                            return; 
                        }
                    }
                }
            }
            if(($("#itxt20").val().length != $("#senha1").val().length) || ($("#itxt20").val() != $("#senha1").val())){
                alert("Os campos de senha devem ser preenchidos com o mesmo valor");
                $("#itxt20").val("");
            }
        }    
    });
    $("#senhanova1").blur(function(){
        if($("#senhanova1").val() != ""){
            if($("#senhanova1").val() != ""){
                var senha = $('#senhanova1').val();
                
                if( senha.length <= 6 ){
                        alert("1-A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#senhanova1').val("");
                        return;
                }else{
                    if($.isNumeric(senha) == true){
                        alert("2-A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#senhanova1').val("");
                        return;
                    }else{
                        var ok = false;
                        for(var i =0; i< senha.length; i++){
                            if( $.isNumeric(senha.charAt(i)) ){
                                ok = true;
                            }
                        }
                        if(ok == false){
                           alert("3-A senha deve ter mais de 6 caracteres. Composta por números e letras");
                            $('#senhanova1').val("");
                            return; 
                        }
                    }
                }
            }
        }    
    });
    $("#senhanova2").blur(function(){
        if($("#senhanova2").val() != ""){
            if($("#senhanova2").val() != ""){
                var senha = $('#senhanova2').val();
                if( senha.length <= 6 ){
                        alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#senhanova2').val("");
                        return;
                }else{
                    if($.isNumeric(senha) == true){
                        alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                        $('#senhanova2').val("");
                        return;
                    }else{
                        var ok = false;
                        for(var i =0; i< senha.length; i++){
                            if( $.isNumeric(senha.charAt(i)) ){
                                ok = true;
                            }
                        }
                        if(ok == false){
                           alert("A senha deve ter mais de 6 caracteres. Composta por números e letras");
                            $('#senhanova2').val("");
                            return; 
                        }
                    }
                }
            }
            if(($("#senhanova2").val().length != $("#senhanova1").val().length) || ($("#senhanova2").val() != $("#senhanova1").val())){
                alert("Os campos de senha devem ser preenchidos com o mesmo valor");
                $("#senhanova2").val("");
            }
        }    
    });
    
    $("#ibtnsenha").click(function(){
        $("#ialtsenha").toggle('slow');
    });
});

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
     
    for (var i = 1; i<= 19; i++){
        $('#itxt'+i+'').val("");   
    }
    
    $("#senha1").val("");

}

function testeEnvio(){
    
    
    for (var i = 1; i<= 19; i++){
        switch (i) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            //case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            //case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                if($('#itxt'+i+'').val() == "" ){ 
                    alert("Preencha o campo: "+$('#itxt'+i+'').attr('placeholder'));
                    return;
                } 
            case 14: //usado para os selects
                if( $('#itxt'+i+'').val() == null ){
                    alert("Preencha o campo: "+$('#itxt'+i+' :selected').html());
                    return;
                }
                break;
        }      
    }
    if($('#senha1').val() == "" || $('#itxt20').val() == ""){ 
        alert("Preencha os campos de senha.");
        return;
    } 
        
    if(confirm('Tem Certeza?') == true){
         return true;
     }else{
         return false;
     }
}

function salvaSenha(){
    
    if($("#senhaantiga").val() != "" && $("#senhanova1").val() != "" && $("#senhanova2").val() != ""){
        var idselec = $("form").attr('data-idselec');
        var senhaantiga = $("#senhaantiga").val();
        var senhanova = $("#senhanova2").val();
        if(senhaantiga == senhanova){
            alert("A senha antiga deve ser diferente da senha nova. Tente Novamente.");
            $("#senhaantiga").val("");
            $("#senhanova1").val("");
            $("#senhanova2").val("");
            return;
        }
        var action = "SalvaSenhaNova";
        if(idselec != "" && senhaantiga != "" && senhanova != ""){
            $.ajax({
                url:baselink+"/ajax/"+action,
                type: 'POST',
                data:{id:idselec, senha1:senhaantiga, senha2:senhanova},
                dataType:'json',
                success:function(json){
                    if(json['resultado'] == 'sim'){ 
                         alert("Senha Nova salva com Sucesso.");
                         window.location.href = baselink+"/funcionarios";
                    }
                    if(json['resultado'] == 'senha'){
                       alert("A senha antiga não está correta. Tente Novamente.");
                    }
                    if(json['resultado'] == 'selecionado'){
                       alert("O id selecionado não foi encontrado. Tente Novamente.");
                    }
                }
            });
            $("#senhaantiga").val("");
            $("#senhanova1").val("");
            $("#senhanova2").val("");
        }    
    }else{
        alert("Preencha os campos adequadamente.");
    }
}
