<h2>Dashboard de Usuário</h2>
<div class="dropdown-divider"></div>
<h3>Informações da Conta de Usuario</h3>
<p>
    <b>Nome:</b>
    <?php echo $nomeUser; ?>
</p>
<p>
    <b>Email:</b>
    <?php echo $emailUser; ?>
</p>

<!-- Botoes de edição -->
<button type="button" name="edit" class="btn btn-danger" data-toggle="modal" data-target="#modalExemplo">Editar</button>
<button type="button" class="btn btn-success">Mudar Senha</button>



<!-- Modal Editar -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="editUsuario\editar_perfil.php">
                    <div class="form-group">
                        <label for="editNome">Nome:</label>
                        <input type="text" name="nome" class="form-control" placeholder="Nome"
                            value="<?php echo $nomeUser; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="<?php echo $emailUser; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editCpf">CPF:</label>
                        <input type="text" name="cpf" class="form-control" value="<?php echo $cpfUser; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="salvar" class="btn btn-success">Salvar mudanças</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>