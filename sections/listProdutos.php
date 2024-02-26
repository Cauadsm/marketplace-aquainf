<?php
require_once 'conexao.php';

// Consultar produtos no banco de dados
$query = "SELECT id, nome, preco, imagem_base64, descricao FROM produtos";
$result = $mysqli->query($query);

if (!$result) {
    die("Erro na consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Lista de Produtos</h2>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Imagem</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='align-middle text-center'>{$row['id']}</td>";
                    echo "<td class='align-middle text-center'>{$row['nome']}</td>";
                    echo "<td class='align-middle text-center'>R$ {$row['preco']}</td>";
                    echo "<td class='align-middle'>{$row['descricao']}</td>";
                    echo "<td class='align-middle text-center'><img src='data:image;base64,{$row['imagem_base64']}' alt='{$row['nome']}' class='img-thumbnail' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "<td class='align-middle text-center'>
                            <a href='#' data-toggle='modal' data-target='#editModal' 
                            data-id='{$row['id']}' 
                            data-nome='{$row['nome']}' 
                            data-preco='{$row['preco']}'
                            data-descricao='{$row['descricao']}'>Editar</a>
                        </td>";
                    echo "<td class='align-middle text-center'><a href='editProdutos/excluir_produto.php?id={$row['id']}' class='text-danger' onclick='return confirm(\"Tem certeza que deseja excluir este produto?\")'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de Edição -->
                    <form action="editProdutos\editar_produto.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label for="editNome">Nome:</label>
                            <input type="text" class="form-control" id="editNome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="editPreco">Preço:</label>
                            <input type="text" class="form-control" id="editPreco" name="preco" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescricao">Descrição:</label>
                            <textarea class="form-control" id="editDescricao" name="descricao" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editImagem">Imagem:</label>
                            <input type="file" class="form-control-file" id="editImagem" name="imagem">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nome = button.data('nome');
            var preco = button.data('preco');
            var descricao = button.data('descricao');

            var modal = $(this);
            modal.find('#editId').val(id);
            modal.find('#editNome').val(nome);
            modal.find('#editPreco').val(preco);
            modal.find('#editDescricao').val(descricao);
        });
    </script>
    <!-- Adicione o link para o Bootstrap JS e o Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>