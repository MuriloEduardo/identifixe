function filterColumn ( i ) {
    
    if(i != ''){
       $('#tabelaservicos').DataTable().column( i ).search(
            $('#ifiltro').val()
        ).draw();
    }else{
        $('#tabelaservicos').DataTable().search(
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
    
    $('#tabelaservicos').DataTable( 
        {
            scrollY: '100vh',
            scrollCollapse: true,
            "scrollX": true,
            
            responsive:true,

            "processing": true,
				"serverSide": true,
				"ajax": {
					"url": baselink+"/ajax/buscaProdutos",
					"type": "POST"
				},
            
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
        
            "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "Todos"]],
            
            "dom": '<l><t><ip>'
        }
        
    );

    
    // coloca as máscaras nos inputs e testes
    $('#itxt1').on('blur',function(){
        if($("#itxt1").val() != ""){
            var nome = $(this).val();
            var action = "ConfereNomeServico";
            if($(this).val() != ''){
                $.ajax({
                    url:baselink+"/ajax/"+action,
                    type: 'POST',
                    data:{q:nome},
                    dataType:'json',
                    success:function(json){
                        if(json.length > 0){
                           $('#itxt1').val("");
                           alert("O Nome do Serviço já existe. Tente outro.");
                        }
                    }
                });
            }
        }
    });
    
    $('#itxt2').mask("#.##0,00", {reverse: true});
    $('#itxt2').on('blur',function(){
        if($("#itxt2").val() != ""){
            var preco = $('#itxt2').val()
                preco = preco.replace(".","").replace(".","").replace(".","").replace(".","");
                preco = preco.replace(",",".");
                preco = parseFloat(preco); 
                                   
            if(preco <= 0){
               alert("O preço deve ser maior do zero.");
               $("#itxt2").val("");
            }
        }       
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
     
    for (var i = 1; i<= 3; i++){
        $('#itxt'+i+'').val("");   
    }

}

function testeEnvio1(){
    if(confirm("Deseja adicionar o Item?") ==  true){
        return true;
    }else{
        return false;
    }  

}

function testeEnvio(){
    //event.preventDefault();
 
    if(confirm("Deseja editar o Item?") ==  true){
        return true;
    }else{
        return false;
    }  
}   
      
    
