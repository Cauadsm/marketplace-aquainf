<?php
include_once 'conexao.php';
#Lista de Usuarios.

$sql = "SELECT * FROM usuario ORDER BY id DESC";

$result = $mysqli->query($sql);


?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome:</th>
            <th scope="col">Email:</th>
            <th scope="col">Senha:</th>
            <th scope="col">CPF:</th>
            <th scope="col">Nivel:</th>
            <th scope="col"></th>

        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope='row'>" . $row['id'] . "</th>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['senha'] . "</td>";
            echo "<td>" . $row['cpf'] . "</td>";
            echo "<td>" . $row['acesso'] . "</td>";
            echo "<td>
            <a class='btn btn-sm' href='#' data-toggle='modal' data-target='#editModal' 
               data-id='{$row['id']}' 
               data-nome='{$row['nome']}' 
               data-email='{$row['email']}' 
               data-senha='{$row['senha']}'
               data-cpf='{$row['cpf']}'
               data-acesso='{$row['acesso']}'>
               <img src='img/svg/icone-edit.svg'  width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
            </a> ";
            echo "</td>";
            echo "</tr>";
        }

        ?>
    </tbody>
</table>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de Edição -->
                <form action="editUsuario\editar_usuario.php" method="post">
                    <input type="hidden" name="id" id="editId">
                    <div class="form-group">
                        <label for="editNome">Nome:</label>
                        <input type="text" class="form-control" id="editNome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editSenha">Senha:</label>
                        <input type="password" class="form-control" id="editSenha" name="senha">
                    </div>
                    <div class="form-group">
                        <label for="editCPF">CPF:</label>
                        <input type="text" class="form-control" id="editCPF" name="cpf">
                    </div>
                    <div class="form-group">
                        <label for="editAcesso">Nível de Acesso:</label>
                        <select class="form-control" id="editAcesso" name="acesso">
                            <option value="1">Administrador</option>
                            <option value="0">Usuário</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Script para abrir o modal -->
<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nome = button.data('nome');
        var email = button.data('email');
        var senha = button.data('senha');
        var cpf = button.data('cpf');
        var acesso = button.data('acesso');

        var modal = $(this);
        modal.find('#editId').val(id);
        modal.find('#editNome').val(nome);
        modal.find('#editEmail').val(email);
        modal.find('#editSenha').val(senha);
        modal.find('#editCPF').val(cpf);
        modal.find('#editAcesso').val(acesso);
    });
</script>