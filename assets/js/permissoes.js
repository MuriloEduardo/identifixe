$(function(){
   $('.table_pm input').click(function(){
        var nomep = $(this).closest('td').children('label').html();
        var valp = $(this).val();
        var idp = '';
        var valpaux = '';
        
        if(nomep.indexOf('_ver') == -1){
            if(nomep.indexOf('relatorios') == -1){
                if(nomep.indexOf('_add') !== -1){
                    valp = valp - 1;
                    idp = '#p_'+valp;
                    if($(idp).is(':checked') == false){
                        $(idp).click();
                    }
                }else if (nomep.indexOf('_edt') !== -1){
                    valp = valp - 2;
                    idp = '#p_'+valp;
                    if($(idp).is(':checked') == false){
                        $(idp).click();
                    }

                }else if (nomep.indexOf('_exc') !== -1){
                    valp = valp - 3;
                    idp = '#p_'+valp;
                    if($(idp).is(':checked') == false){
                        $(idp).click();
                    }
                }
            }else{
                valp = valp - 1;
                idp = '#p_'+valp;
                if($(idp).is(':checked') == false){
                    $(idp).click();
                }
            }    
        }else{
            if($(this).is(':checked') == false){
               var idp1 = '#p_'+(parseInt(valp)+1);
               var idp2 = '#p_'+(parseInt(valp)+2);
               var idp3 = '#p_'+(parseInt(valp)+3);
               if($(idp1).is(':checked')){
                  $(idp1).prop('checked', false); 
               }
               if($(idp2).is(':checked')){
                  $(idp2).prop('checked', false); 
               }
               if($(idp3).is(':checked')){
                  $(idp3).prop('checked', false); 
               }
               
            }
        }
   });
   
   $('#igrupos').DataTable( 
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
   
});
