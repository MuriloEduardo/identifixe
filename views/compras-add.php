<link href="<?php echo BASE_URL;?>/assets/css/compras.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/compras.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'; var targetCols1 = 8;</script>

<h1 class="titulo_cp">ADICIONAR COMPRA</h1>

<div class="form_linha">
    <div class="form_itemLinha">
        <div class="btn_busca2" id="btnBusca">Buscar Produto</div>
    </div>
</div>
<div class="form_linha">
    <div class="form_itemLinha">
        <div id="campoFlex1">
        <!-- Filtros da busca de produtos -->
        <div class="form_linha">
            <div class="form_itemLinha">
                <label for="ipesqglobal">Pesquisar em TODAS as Colunas por:</label>
                <input type="text" id="ipesqglobal" />
            </div>
            <div class="form_itemLinha">
                <label style="color: #CCC;">.</label>
                <div class="btn_busca" onclick="limparFiltros()">Limpar Filtros</div>
            </div>
        </div>
        <div class="form_linha">
            <div class="form_itemLinha">
                <label for="ivalores">Filtrar Valores da Coluna:</label>
                <select id="ivalores">
                    <option value="" selected></option>
                    <?php for($i = 2; $i< count($listaColunasE)-2; $i++):?>
                        <?php if($listaColunasE[$i]["tipo"] == "float"):?>
                            <option value="<?php echo ($i-1);?>"><?php echo ucwords(str_replace("_", " ", $listaColunasE[$i]['nomecol']))?></option>
                        <?php endif;?>    
                    <?php endfor;?>
                </select>
            </div>
            <div class="form_itemLinha">
                <label for="ivlmin">Valor Inicial:</label>
                <input type="text" id="ivlmin" />
            </div>
            <div class="form_itemLinha">
                <label for="ivlmax">Valor Final:</label>
                <input type="text" id="ivlmax" />
            </div>
        </div>
        <div class="form_linha">
            <div class="form_itemLinha">
                <label for="icampo1">Procurar pela Coluna:</label>
                <select  id="icampo1">
                    <option value="" selected disabled></option>
                    <?php for($i = 2; $i< count($listaColunasE)-2; $i++):?>
                        <?php if($listaColunasE[$i]["tipo"] != "float" ):?>
                            <option value="<?php echo ($i-1);?>"><?php echo ucwords(str_replace("_", " ", $listaColunasE[$i]['nomecol']))?></option>
                        <?php endif;?>
                    <?php endfor;?>
                </select>
            </div>
            <div class="form_itemLinha">
                <label for="ifiltro1">Procurar Por:</label>
                <input type="text" id="ifiltro1" />
            </div>
        </div>

        <!-- tabela com os produtos-->
        <table id="tabelaestoque" class="display nowrap" cellspacing="0"  style="width: 100%" >
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" onchange="selecionaTodos(this)" id="iselectodos1">
                        <label for="iselectodos1">Todos</label>
                    </th>
                    <?php for($i = 2; $i< count($listaColunasE)-2; $i++):?>
                        <th><?php echo ucwords(str_replace("_", " ", $listaColunasE[$i]['nomecol']))?></th>
                    <?php endfor;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaEstoque as $chave => $valor ):?>
                    <tr>
                        <td>
                            <input type="checkbox" onchange="selecionaLinha(this)"/>
                        </td>

                        <?php for($col = 2; $col < count($listaColunasE)-2; $col++):?>
                            <?php if($listaColunasE[$col]["tipo"] == "date"):?>

                                <?php if(floatval(str_replace("-", "",$listaEstoque[$chave][$col])) == 0):?>
                                    <td></td>
                                <?php else:?>
                                    <td><?php $dtaux = explode("-",$listaEstoque[$chave][$col]); echo $dtaux[2]."/".$dtaux[1]."/".$dtaux[0];?></td>
                                <?php endif;?>    

                            <?php elseif ($listaColunasE[$col]["tipo"] == "float"):?>

                                <td><?php echo number_format($listaEstoque[$chave][$col],2,",",".");?></td>

                            <?php elseif ($listaColunasE[$col]["tipo"] == "tinyint(4)"):?>

                                <?php if(floatval($listaEstoque[$chave][$col]) == 0):?>
                                    <td> Não </td>
                                <?php else:?>
                                    <td> Sim </td>
                                <?php endif;?> 

                            <?php else:?>

                                <td><?php echo utf8_encode(ucwords(strtolower($listaEstoque[$chave][$col])));?></td>

                            <?php endif;?>
                        <?php endfor;?>              
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <div class="form_linha">
            <div class="form_itemLinha">
                <label style="color: #CCC;">.</label>
                <div class="btn_busca2" onclick="inserirItem()">Selecionar Item(ens):</div>
            </div>
        </div>    
    </div>
    </div>    
</div>

<div class="form_linha">
    <div class="form_itemLinha">
        <div class="btn_busca2" id="btnComposicao">Composição da Compra
        </div>
    </div>
</div>
<div class="form_linha">
    <div class="form_itemLinha">
        <div id="campoFlex2">
            <form method="POST">
    
            <table class="table_add" id="tabelaenvio">
                <thead>
                    <tr>
                        <th>Ações</th>
                        <?php for($i = 3; $i< count($listaItens)-2; $i++):?>
                            <th><?php echo ucwords(str_replace("_", " ", $listaItens[$i]['nomecol']))?></th>
                        <?php endfor;?>
                    </tr>
                </thead>

                <tbody>
                </tbody>    
            </table>
        </div>
    </div>
</div>

<div class="form_linha">
    <div class="form_itemLinha">
        <div class="btn_busca2" id="btnPgto">Pagamento
        </div>
    </div>
</div>
<div class="form_linha">
    <div class="form_itemLinha">
        <div id="campoFlex3">
            
            <div class="form_linha">
                <div class="form_itemLinha">
                    <label for="aux1">Número Nota Fiscal:</label>
                    <input type="text" name="aux1" id="iaux1" />
                </div>
                <div class="form_itemLinha">
                    <label for="aux2">Data da Compra:</label>
                    <input type="text" name="aux2" id="iaux2" />
                </div>
            </div>
            <div class="form_linha">
                <div class="form_itemLinha">
                    <label for="aux3">Custo do Frete:</label>
                    <input type="text" name="aux3" id="iaux3" />
                </div>
                <div class="form_itemLinha">
                    <label for="aux4">Custo Total:</label>
                    <input type="text" name="aux4" id="iaux4" />
                </div>
            </div>
    
            <div class="form_linha">
                <div class="form_itemLinha">
                    <label for="ifavorecido">Favorecido:</label>
                    <input type="text" id="ifavorecido" />
                </div>
                <div class="form_itemLinha">
                    <label for="icc">Conta Corrente:</label>
                    <select  id="icc">
                        <option value=""></option>
                        <?php foreach ($listaContasCorrentes as $cc):?>
                            <option value="<?php echo $cc["id"]?>" ><?php echo ucwords($cc["nome"]);?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form_linha">
                <div class="form_itemLinha">
                    <label for="iformapgto">Forma de Pagamento:</label>
                    <select id="iformapgto" name="formapgto">
                        <option value=""></option>
                        <?php foreach ($listaFormasPgto as $fp):?>
                            <option value="<?php echo $fp["id"]?>" ><?php echo utf8_encode(ucwords($fp["nome"]));?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form_itemLinha">
                    <label for="icondpgto">Condição de Pagamento:</label>
                    <select id="icondpgto" name="condpgto">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="form_linha" id="infoparcela">
                <div class="form_itemLinha">
                    <label for="inroparcela">Núm. Parcelas:</label>
                    <select id="inroparcela" name="nroparcela">
                        <option value=""></option>
                        <?php for($i=0; $i<=12; $i++ ):?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="form_itemLinha">
                    <label for="idiavenc">Dia do Vencimento:</label>
                    <select id="idiavenc" name="diavenc">
                        <option value=""></option>
                        <?php for($i=1; $i<=31; $i++ ):?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php endfor;?>
                    </select>
                </div>
            </div>
            <div class="form_linha">
                <div class="form_itemLinha">
                    <div class="botao_cp" onclick="testeEnvio()">Lançar</div>
                </div>
            </div>
        </div>
    </div>
</div>    
</form>
        </div>    
    </div>
</div>
<!--<div style="clear: both"></div>-->


