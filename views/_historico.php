<?php if (isset($logs)): ?>
    <section id="historico">
        <h2 class="text-center mt-5">Histórico</h2>
        <div class="row">
            <div class="col">
                <?php foreach ($logs as $data => $value_logs): ?>
                    <div class="historico my-4 py-2">
                        <h6><?php echo strftime("%A, %d de %B de %Y", strtotime($data)) ?></h6>
                        <ul class="list-group">
                            <?php foreach ($value_logs as $key_children => $value_children): ?>
                                <li class="list-group-item <?php echo $value_children["tipo"] ?>">
                                    <p class="small m-0">
                                        <?php echo "<span class='font-weight-bold'>" . $value_logs[$key_children]["funcionario_nome"] . "</span> com o ip <span class='font-weight-bold'>" . $value_logs[$key_children]["funcionario_ip"] . "</span>" ?>
                                        <?php if ($value_children["tipo"] === "alteracao"): ?>
                                            <?php foreach ($value_children["alteracoes"] as $key_son => $value_son): ?>
                                                <?php echo " alterou o campo <span class='font-weight-bold'>" . $value_son["campo"] . "</span> <del class='text-muted'>de " . $value_son["de"] . "</del> <ins>para " . $value_son["para"] . "</ins>" ?>
                                            <?php endforeach ?>
                                        <?php elseif ($value_children["tipo"] === "cadastro"): ?>
                                            cadastrou este item
                                        <?php endif ?>
                                        <br>
                                        <span class="text-muted">às <?php echo strftime("%X", strtotime($value_children["hora"])) ?></span>
                                    </p>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
<?php endif ?>