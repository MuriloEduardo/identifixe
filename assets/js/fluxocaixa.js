function lancaFluxo(proxid, nropedido, mov, sintetica, analitica, descricao, cc, bandeira, favorecido, dtop, valortotal, formapgto, condpgto, nroparc, diavenc, distdias = 0){
/////////////////////////// LANÇAMENTO INTEIRO FEITO A VISTA - EXCLUINDO RECEITA DE CARTÃO DÉBITO
    if(condpgto = "À Vista" & (formapgto != "Cartão Débito" | formapgto != "Cartão Crédito")){
        var arraylinhas = new Array();
        var linha  = "<tr>";
        linha += "<td>"+"<a href='#' class='botao_peq_lc' onclick='editar(this) data-ident="+proxid+" '>Editar</a>"+"</td>";                                          //ação
        linha += "<td>"+"<input type='text' name='nropedido["+proxid+"]' class='input-table-selec'  value='"+nropedido+"' readonly='readonly' required/>"+"<td>";     //nro pedido
        linha += "<td>"+"<input type='text' name='mov["+proxid+"]' class='input-table-selec'  value='"+mov+"' readonly='readonly' required/>"+"<td>";                 //movimentação
        linha += "<td>"+"<input type='text' name='sintetica["+proxid+"]' class='input-table-selec'  value='"+sintetica+"' readonly='readonly' required/>"+"<td>";     //sintetica
        linha += "<td>"+"<input type='text' name='analitica["+proxid+"]' class='input-table-selec'  value='"+analitica+"' readonly='readonly' required/>"+"<td>";     //analitica
        linha += "<td>"+"<input type='text' name='descricao["+proxid+"]' class='input-table-selec'  value='"+descricao+"' readonly='readonly' required/>"+"<td>";     //detalhe
        linha += "<td>"+"<input type='text' name='cc["+proxid+"]' class='input-table-selec'  value='"+cc+"' readonly='readonly' required/>"+"<td>";                   //c corrente
        linha += "<td>"+"<input type='text' name='bandeira["+proxid+"]' class='input-table-selec'  value='"+bandeira+"' readonly='readonly' required/>"+"<td>";       //bandeira
        linha += "<td>"+"<input type='text' name='favorecido["+proxid+"]' class='input-table-selec'  value='"+favorecido+"' readonly='readonly' required/>"+"<td>";   //favorecido
        linha += "<td>"+"<input type='text' name='dtop["+proxid+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";               //data op
        linha += "<td>"+"<input type='text' name='valortotal["+proxid+"]' class='input-table-selec'  value='"+valortotal+"' readonly='readonly' required/>"+"<td>";   //valor tot
        linha += "<td>"+"<input type='text' name='formapgto["+proxid+"]' class='input-table-selec'  value='"+formapgto+"' readonly='readonly' required/>"+"<td>";     //forma pgto
        linha += "<td>"+"<input type='text' name='condpgto["+proxid+"]' class='input-table-selec'  value='"+condpgto+"' readonly='readonly' required/>"+"<td>";       //cond pgto
        linha += "<td>"+"<input type='text' name='nroparc["+proxid+"]' class='input-table-selec'  value='1|1' readonly='readonly' required/>"+"<td>";                 //parcelas        
        linha += "<td>"+"<input type='text' name='dtvenc["+proxid+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";             //dt venc
        linha += "<td>"+"<input type='text' name='valorpago["+proxid+"]' class='input-table-selec'  value='"+valortotal+"' readonly='readonly' required/>"+"<td>";    //valor pago
        linha += "<td>"+"<input type='text' name='dtquit["+proxid+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";             //dt quit
        linha += "<td>"+"<input type='text' name='status["+proxid+"]' class='input-table-selec'  value='Quitado' readonly='readonly' required/>"+"<td>";              //status
        linha += "<td>"+"<input type='text' name='observ["+proxid+"]' class='input-table-selec'  value='' readonly='readonly' required/>"+"<td>";                     //observ
        linha += "</tr>";
        
        arraylinhas.push(linha);        
        return arraylinhas;
    }

/////////////////////////// LANÇAMENTO INTEIRO FEITO EM UMA VEZ - DISTÂNCIA DO VENCIMENTO EM DIAS
    if( formapgto == "Cartão Débito" | (formapgto == "Cartão Crédito" & condpgto == "Com Juros") | (formapgto == "Cartão Crédito" & condpgto == "Antecipado")){
        var arraylinhas = new Array();
        
        var linha  = "<tr>";
        linha += "<td>"+"<a href='#' class='botao_peq_lc' onclick='editar(this) data-ident="+proxid+" '>Editar</a>"+"</td>";                                          //ação
        linha += "<td>"+"<input type='text' name='nropedido["+proxid+"]' class='input-table-selec'  value='"+nropedido+"' readonly='readonly' required/>"+"<td>";     //nro pedido
        linha += "<td>"+"<input type='text' name='mov["+proxid+"]' class='input-table-selec'  value='"+mov+"' readonly='readonly' required/>"+"<td>";                 //movimentação
        linha += "<td>"+"<input type='text' name='sintetica["+proxid+"]' class='input-table-selec'  value='"+sintetica+"' readonly='readonly' required/>"+"<td>";     //sintetica
        linha += "<td>"+"<input type='text' name='analitica["+proxid+"]' class='input-table-selec'  value='"+analitica+"' readonly='readonly' required/>"+"<td>";     //analitica
        linha += "<td>"+"<input type='text' name='descricao["+proxid+"]' class='input-table-selec'  value='"+descricao+"' readonly='readonly' required/>"+"<td>";     //detalhe
        linha += "<td>"+"<input type='text' name='cc["+proxid+"]' class='input-table-selec'  value='"+cc+"' readonly='readonly' required/>"+"<td>";                   //c corrente
        linha += "<td>"+"<input type='text' name='bandeira["+proxid+"]' class='input-table-selec'  value='"+bandeira+"' readonly='readonly' required/>"+"<td>";       //bandeira
        linha += "<td>"+"<input type='text' name='favorecido["+proxid+"]' class='input-table-selec'  value='"+favorecido+"' readonly='readonly' required/>"+"<td>";   //favorecido
        linha += "<td>"+"<input type='text' name='dtop["+proxid+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";               //data op
        linha += "<td>"+"<input type='text' name='valortotal["+proxid+"]' class='input-table-selec'  value='"+valortotal+"' readonly='readonly' required/>"+"<td>";   //valor tot
        linha += "<td>"+"<input type='text' name='formapgto["+proxid+"]' class='input-table-selec'  value='"+formapgto+"' readonly='readonly' required/>"+"<td>";     //forma pgto
        linha += "<td>"+"<input type='text' name='condpgto["+proxid+"]' class='input-table-selec'  value='"+condpgto+"' readonly='readonly' required/>"+"<td>";       //cond pgto
        linha += "<td>"+"<input type='text' name='nroparc["+proxid+"]' class='input-table-selec'  value='1|1' readonly='readonly' required/>"+"<td>";                 //parcelas   
        
        if(distdias != 0){
            var dtaux = dtop.split("/");
            var dtvenc = new Date(dtaux[2],parseInt(dtaux[1])-1,dtaux[0]);
            //soma a quantidade de dias para o recebimento/pagamento
            dtvenc.setDate(dtvenc.getDate() + distdias);
            //verifica se a data final cai no final de semana, se sim, coloca para o primeiro dia útil seguinte
            if(dtvenc.getDay() == 6){
               dtvenc.setDate(dtvenc.getDate() + 2); 
            }
            if(dtvenc.getDay() == 0){
               dtvenc.setDate(dtvenc.getDate() + 1); 
            }
            //monta a data no padrao brasileiro
            var dia = dtvenc.getDate();
            var mes = dtvenc.getMonth()+1;
            var ano = dtvenc.getFullYear(); 
            if (dia.toString().length == 1){
                dia = "0"+dtvenc.getDate();
            }
            if(mes.toString().length == 1){
                mes = "0"+mes;
            }
            dtvenc = dia+"/"+mes+"/"+ano;
            linha += "<td>"+"<input type='text' name='dtvenc["+proxid+"]' class='input-table-selec'  value='"+dtvenc+"' readonly='readonly' required/>"+"<td>";       //dt venc
        }else{
            //caso a distancia em dias seja o padrão, igual a zero, a dt vencimento fica igual a dt operação
            linha += "<td>"+"<input type='text' name='dtvenc["+proxid+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";         //dt venc
        }
        
        linha += "<td>"+"<input type='text' name='valorpago["+proxid+"]' class='input-table-selec'  value='' readonly='readonly' required/>"+"<td>";                  //valor pago
        //teste redundante para manter a ordem das <td> e facilitar a edição
        if(distdias != 0){
            linha += "<td>"+"<input type='text' name='dtquit["+proxid+"]' class='input-table-selec'  value='"+dtvenc+"' readonly='readonly' required/>"+"<td>";       //dt quit
        }else{
            linha += "<td>"+"<input type='text' name='dtquit["+proxid+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";         //dt quit
        }
        linha += "<td>"+"<input type='text' name='status["+proxid+"]' class='input-table-selec'  value='A Quitar' readonly='readonly' required/>"+"<td>";             //status
        linha += "<td>"+"<input type='text' name='observ["+proxid+"]' class='input-table-selec'  value='' readonly='readonly' required/>"+"<td>";                     //observ
        linha += "</tr>";
        
        arraylinhas.push(linha);        
        return arraylinhas;
    }
    
/////////////////////////// LANÇAMENTO INTEIRO FEITO PARCELADO - DISTANCIA DO VENCIMENTO EM MESES
    if(condpgto = "Parcelado" & nroparc > 0){
        var arraylinhas = new Array();
        var linha;
        
        var valtot = valortotal.replace(",",".");
            valtot = parseFloat(valtot).toFixed(2) / parseInt(nroparc);
            valtot = parseFloat(valtot).toFixed(2);
            
        for( var pr = 0; pr < nroparc ; pr++ ){
            linha = "";
            linha = "<tr>";
            linha += "<td>"+"<a href='#' class='botao_peq_lc' onclick='editar(this) data-ident="+(proxid + pr)+" '>Editar</a>"+"</td>";                                       //ação
            linha += "<td>"+"<input type='text' name='nropedido["+(proxid + pr)+"]' class='input-table-selec'  value='"+nropedido+"' readonly='readonly' required/>"+"<td>";  //nro pedido
            linha += "<td>"+"<input type='text' name='mov["+(proxid + pr)+"]' class='input-table-selec'  value='"+mov+"' readonly='readonly' required/>"+"<td>";              //movimentação
            linha += "<td>"+"<input type='text' name='sintetica["+(proxid + pr)+"]' class='input-table-selec'  value='"+sintetica+"' readonly='readonly' required/>"+"<td>";  //sintetica
            linha += "<td>"+"<input type='text' name='analitica["+(proxid + pr)+"]' class='input-table-selec'  value='"+analitica+"' readonly='readonly' required/>"+"<td>";  //analitica
            linha += "<td>"+"<input type='text' name='descricao["+(proxid + pr)+"]' class='input-table-selec'  value='"+descricao+"' readonly='readonly' required/>"+"<td>";  //detalhe
            linha += "<td>"+"<input type='text' name='cc["+(proxid + pr)+"]' class='input-table-selec'  value='"+cc+"' readonly='readonly' required/>"+"<td>";                //c corrente
            linha += "<td>"+"<input type='text' name='bandeira["+(proxid + pr)+"]' class='input-table-selec'  value='"+bandeira+"' readonly='readonly' required/>"+"<td>";    //bandeira
            linha += "<td>"+"<input type='text' name='favorecido["+(proxid + pr)+"]' class='input-table-selec'  value='"+favorecido+"' readonly='readonly' required/>"+"<td>";//favorecido
            linha += "<td>"+"<input type='text' name='dtop["+(proxid + pr)+"]' class='input-table-selec'  value='"+dtop+"' readonly='readonly' required/>"+"<td>";            //data op
            linha += "<td>"+"<input type='text' name='valortotal["+(proxid + pr)+"]' class='input-table-selec'  value='"+valtot+"' readonly='readonly' required/>"+"<td>";    //valor tot
            linha += "<td>"+"<input type='text' name='formapgto["+(proxid + pr)+"]' class='input-table-selec'  value='"+formapgto+"' readonly='readonly' required/>"+"<td>";  //forma pgto
            linha += "<td>"+"<input type='text' name='condpgto["+(proxid + pr)+"]' class='input-table-selec'  value='"+condpgto+"' readonly='readonly' required/>"+"<td>";    //cond pgto
            linha += "<td>"+"<input type='text' name='nroparc["+(proxid + pr)+"]' class='input-table-selec'  value='"+(pr+1)+"|"+nroparc+"' readonly='readonly' required/>"+"<td>";//parcelas
            
            var dtaux = dtop.split("/");
            var dtvencaux = new Date(dtaux[2],parseInt(dtaux[1])-1,dtaux[0]);
            //soma a quantidade de meses para o recebimento/pagamento
            dtvencaux.setDate(dtvenc.getMOnth() + (pr+1) );
            //transforma em data para verificar o dia da semana
            var dtvenc = new Date(dtaux[2],dtvencaux.getMonth(),diavenc);
            //verifica se a data final cai no final de semana, se sim, coloca para o primeiro dia útil seguinte
            if(dtvenc.getDay() == 6){
               dtvenc.setDate(dtvenc.getDate() + 2); 
            }
            if(dtvenc.getDay() == 0){
               dtvenc.setDate(dtvenc.getDate() + 1); 
            }
            //monta a data no padrao brasileiro
            var dia = dtvenc.getDate();
            var mes = dtvenc.getMonth()+1;
            var ano = dtvenc.getFullYear(); 
            if (dia.toString().length == 1){
                dia = "0"+dtvenc.getDate();
            }
            if(mes.toString().length == 1){
                mes = "0"+mes;
            }
            dtvenc = dia+"/"+mes+"/"+ano;
            
            linha += "<td>"+"<input type='text' name='dtvenc["+(proxid + pr)+"]' class='input-table-selec'  value='"+dtvenc+"' readonly='readonly' required/>"+"<td>";          //dt venc
            linha += "<td>"+"<input type='text' name='valorpago["+(proxid + pr)+"]' class='input-table-selec'  value='' readonly='readonly' required/>"+"<td>";               //valor pago
            linha += "<td>"+"<input type='text' name='dtquit["+(proxid + pr)+"]' class='input-table-selec'  value='' readonly='readonly' required/>"+"<td>";                  //dt quit
            linha += "<td>"+"<input type='text' name='status["+(proxid + pr)+"]' class='input-table-selec'  value='A Quitar' readonly='readonly' required/>"+"<td>";          //status
            linha += "<td>"+"<input type='text' name='observ["+(proxid + pr)+"]' class='input-table-selec'  value='' readonly='readonly' required/>"+"<td>";                  //observ
            linha += "</tr>";
            
            arraylinhas.push(linha);
            
        }
        return arraylinhas;
    }    

}// FINAL DA FUNÇÃO DE LANÇAMENTO NO CAIXA


//
//Public Sub LançaDespesa(dataOperaçao As Date, nroNtaFiscal As String, conta As String, sintetica As String, analitica As String, detalhe As String, prestadora As String, fornecedor As String, valorBruto As Double, forma As String, condiçao As String, nroParcela As Integer, diaVencimento As Integer, banco As String, bandeira As String, Optional idORÇ As String, Optional idOS As String, Optional nroOS As String, Optional custoOPfinanceira As Double, Optional observaçao As String)
//'1) txtbox com a data da operaçao
//'2) txtbox com o nro da nota fiscal
//'3) combobox com a conta financeira
//'4) combobox com a conta sintetica
//'5) combobox com a conta analitica
//'6) txtbox com a descrição detalhada da operação
//'7) combobox com a empresa prestadora de serviço
//'8) combobox/textbox com o forncedor
//'9) txtbox com o valor bruto da operação
//'10) combobox com a forma de pagamento
//'11) combobox com a condição de pagamento
//'12) txtbox com o numero de parcelas da operaçao
//'13) combobox com o dia de vencimento da operação
//'14) combobox com o banco | caixa da empresa
//'15) combobox com o a bandeira de cartao usada
//'16) txtbox com o id do orçamento [OPCIONAL]
//'17) txtbox com o id da Ordem de Serviço [OPCIONAL]
//'18) txtbox com o numero da Ordem de Serviço [OPCIONAL]
//'19) txtbox com o custo de operação financeira [OPCIONAL]
//'20) txtbox com a observação geral da operação [OPCIONAL]
//Dim custoOP As Double
//custoOP = 0
//
//If custoOPfinanceira <> 0 Then
//   custoOP = CDbl(custoOPfinanceira)
//End If
//'LANÇAMENTO DA DESPESA
//Sheets(tabelaFluxoCaixa).Select
//If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase(detalhe), UCase(prestadora), UCase(fornecedor), False, (-1) * CDbl(valorBruto), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao)) = False Then
//   MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//   Exit Sub
//End If
//
//If UCase(forma) = UCase("TED") Or UCase(forma) = UCase("DOC") And custoOP > 0 Then
//If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", "", CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase("CUSTO DE OPERAÇÃO FINANCEIRA - ") & UCase(forma), UCase(prestadora), UCase(fornecedor), False, (-1) * CDbl(custoOPfinanceira), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao)) = False Then
//   MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//   Exit Sub
//End If
//End If
//End Sub
//
//Public Sub lançaReceita(dataOperaçao As Date, nroNtaFiscal As String, conta As String, sintetica As String, analitica As String, detalhe As String, prestadora As String, cliente As String, valorBruto As Double, forma As String, condiçao As String, nroParcela As Integer, diaVencimento As Integer, banco As String, bandeira As String, Optional idORÇ As String, Optional idOS As String, Optional nroOS As String, Optional custoOPfinanceira As Double, Optional observaçao As String, Optional valorTaxa As Double, Optional diasReceber As Integer, Optional taxaISSQN As Double)
//'1) txtbox com a data da operaçao
//'2) txtbox com o nro da nota fiscal
//'3) combobox com a conta financeira
//'4) combobox com a conta sintetica
//'5) combobox com a conta analitica
//'6) txtbox com a descrição detalhada da operação
//'7) combobox com a empresa prestadora de serviço
//'8) combobox/textbox com o cliente
//'9) txtbox com o valor bruto da operação
//'10) combobox com a forma de pagamento
//'11) combobox com a condição de pagamento
//'12) txtbox com o numero de parcelas da operaçao
//'13) combobox com o dia de vencimento da operação
//'14) combobox com o banco | caixa da empresa
//'15) combobox com o a bandeira de cartao usada
//'16) txtbox com o id do orçamento [OPCIONAL]
//'17) txtbox com o id da Ordem de Serviço [OPCIONAL]
//'18) txtbox com o numero da Ordem de Serviço [OPCIONAL]
//'19) txtbox com o custo de operação financeira [OPCIONAL]
//'20) txtbox com a observação geral da operação [OPCIONAL]
//'21) valor da taxa que será cobrada para receber no cartão (R$)
//'22) numero de dias a partir da data da op que irá receber o valor
//'23) txiss do issqn retido
//Dim pj As Boolean
//pj = False
//If taxaISSQN > 0 Then
//   pj = True
//Else
//   pj = False
//End If
//
//Select Case UCase(forma)
//
//       Case UCase("CARTÃO DÉBITO")
//            If UCase(condiçao) = UCase("À VISTA") Then
//               'TAXA DE DÉBITO  - ENTRADA
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase(detalhe), UCase(prestadora), UCase(cliente), pj, CDbl(valorBruto), CDbl(taxaISSQN), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao), diasReceber) = False Then
//               'If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, "", "", UCase(nroOS), CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase(detalhe), UCase(prestadora), UCase(cliente), False, CDbl(valorBruto), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao), diasReceber) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//
//               'TAXA DE DÉBITO  - SAÍDA EQUIVALENTE A TAXA DE DÉBITO
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), "", UCase("despesa"), UCase("despesa financeira"), UCase("tarifa bancária"), UCase(detalhe) & UCase(" - taxa débito"), UCase(prestadora), UCase(cliente), False, (-1) * CDbl(valorTaxa), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao), diasReceber) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//            End If
//            
//       Case UCase("CARTÃO CRÉDITO")
//            If UCase(condiçao) = UCase("CRÉDITO COM JUROS") Or UCase(condiçao) = UCase("CRÉDITO SEM JUROS COM ANTECIPAÇÃO") Then
//               'TAXA CRÉDITO C/ JUROS - ENTRADA - RECEBE VALOR INTEGRAL DESCONTADO DE UMA TAXA D+30 NORMALMENTE
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase(detalhe), UCase(prestadora), UCase(cliente), pj, CDbl(valorBruto), CDbl(taxaISSQN), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao), diasReceber) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//            
//               'TAXA CRÉDITO C/ JUROS - SAÍDA EQUIVALENTE A TAXA - RECEBE VALOR INTEGRAL DESCONTADO DE UMA TAXA D+30 NORMALMENTE
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), "", UCase("despesa"), UCase("despesa financeira"), UCase("tarifa bancária"), UCase(detalhe) & UCase(" - TAXA CRÉDITO"), UCase(prestadora), UCase(cliente), False, (-1) * CDbl(valorTaxa), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao), diasReceber) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//            End If
//            
//            If UCase(condiçao) = UCase("CRÉDITO SEM JUROS SEM ANTECIPAÇÃO") Then
//               'TAXA CRÉDITO S/ JUROS - ENTRADA - RECEBE VALOR DE ACORDO COM OS MESES
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase(detalhe), UCase(prestadora), UCase(cliente), pj, CDbl(valorBruto), CDbl(taxaISSQN), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao)) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//            
//               'TAXA CRÉDITO S/ JUROS - SAÍDA EQUIVALENTE A TAXA - RECEBE VALOR DE ACORDO COM OS MESES
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), "", UCase("despesa"), UCase("despesa financeira"), UCase("tarifa bancária"), UCase(detalhe) & UCase(" - TAXA CRÉDITO"), UCase(prestadora), UCase(cliente), False, (-1) * CDbl(valorTaxa), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao)) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//            End If
//
//       Case Else
//            'LANÇAMENTO DA RECEITA
//            If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), UCase(nroNtaFiscal), UCase(conta), UCase(sintetica), UCase(analitica), UCase(detalhe), UCase(prestadora), UCase(cliente), pj, CDbl(valorBruto), CDbl(taxaISSQN), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao)) = False Then
//               MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//               Exit Sub
//            End If
//            
//            If custoOPfinanceira <> 0 Then
//               'LANÇAMENTO DA DESPESA COM A OPERAÇÃO
//               If CAIXA.LANÇA_FLUXOCAIXA(tabelaFluxoCaixa, Range(LetColAuxReg_FC & 2).Column, idORÇ, "", UCase(nroOS), CDate(dataOperaçao), "", UCase("despesa"), UCase("despesa financeira"), UCase("tarifa bancária"), UCase("CUSTO DE OPERAÇÃO FINANCEIRA - ") & UCase(forma), UCase(prestadora), UCase(cliente), False, (-1) * CDbl(custoOPfinanceira), CDbl(0), UCase(forma), UCase(condiçao), CInt(nroParcela), CInt(diaVencimento), UCase(banco), UCase(bandeira), UCase(observaçao)) = False Then
//                  MsgBox UCase("Não foi possível fazer o lançamento da sua operação. tente novamente.")
//                  Exit Sub
//               End If
//            End If
//End Select
//
//End Sub



