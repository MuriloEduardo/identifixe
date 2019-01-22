<script src="<?php echo BASE_URL;?>/assets/js/table_form.js" type="text/javascript"></script>
<form id="contatos-form" class="needs-validation" novalidate>
    <div class="table-responsive">
        <h3 class="mt-5 mb-4">Contatos</h3>
        <table id="contatos" class="table table-striped table-hover bg-white mb-5">
            <thead>
                <tr>
                    <th class="border-bottom-0">Nome</th>
                    <th class="border-bottom-0">Setor</th>
                    <th class="border-bottom-0">Celular</th>
                    <th class="border-bottom-0">Email</th>
                    <th class="border-bottom-0">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr role="form">
                    <td>
                        <input type="text" class="form-control" name="contato_nome" required>
                        <div class="invalid-feedback">Por favor, preencha o nome.</div>
                        <div class="valid-feedback">Ok!</div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="contato_setor">
                        <div class="valid-feedback">Ok!</div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="contato_celular" required>
                        <div class="invalid-feedback">Por favor, preencha o celular.</div>
                        <div class="valid-feedback">Ok!</div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="contato_email" required>
                        <div class="invalid-feedback">Por favor, preencha o email.</div>
                        <div class="valid-feedback">Ok!</div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Incluir</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>