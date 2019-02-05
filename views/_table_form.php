<script src="<?php echo BASE_URL;?>/assets/js/table_form.js" type="text/javascript"></script>
<form id="contatos-form" class="needs-validation" novalidate>
    <div class="table-responsive">
        <h3 class="mt-5 mb-4">Contatos</h3>
        <table id="contatos" class="table table-striped table-hover bg-white mb-5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Setor</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                <tr role="form">
                    <td>
                        <input type="text" class="form-control" name="contato_nome" required>
                        <div class="invalid-feedback">Por favor, preencha o nome.</div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="contato_setor">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="contato_celular" required>
                        <div class="invalid-feedback">Por favor, preencha o celular.</div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="contato_email" required>
                        <div class="invalid-feedback">Por favor, preencha o email.</div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Incluir</a>
                    </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</form>