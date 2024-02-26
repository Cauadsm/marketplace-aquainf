<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
</head>

<body>
    <h2>Cadastro de Produto</h2>
    <form action="editProdutos\processa_produto.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome do Produto:</label>
        <input id="form2Example17" class="form-control form-control-lg" type="text" name="nome" required>
        <br>
        <label for="preco">Preço:</label>
        <input id="form2Example17" class="form-control form-control-lg" type="number" name="preco" required>
        <br>
        <label for="descricao">Descrição:</label>
        <textarea id="form2Example17" class="form-control form-control-lg" name="descricao" rows="4"
            required></textarea>
        <br>
        <label for="imagem">Imagem:</label>
        <input class="btn btn-lg btn-block" type="file" name="imagem" accept="image/*" required>
        <br>
        <input class="btn btn-success btn-lg btn-block" type="submit" value="Cadastrar">
    </form>
</body>

</html>