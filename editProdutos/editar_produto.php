<?php
require_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    // Atualizar a imagem se uma nova foi colcoada
    if (!empty($_FILES['imagem']['name'])) {
        $imagem_base64 = base64_encode(file_get_contents($_FILES['imagem']['tmp_name']));
        $query = "UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao', imagem_base64='$imagem_base64' WHERE id=$id";
    } else {
        // Se não houver nova imagem, atualizar apenas os outros campos
        $query = "UPDATE produtos SET nome='$nome', preco='$preco', descricao='$descricao' WHERE id=$id";
    }

    $result = $mysqli->query($query);

    if ($result) {
        // Sucesso na atualização
        header("Location: ../adminPainel.php?aqua=dashboardAdmin&section=listProdutos"); // Redirecionar para a lista de produtos
        exit();
    } else {
        // Erro na atualização
        die("Erro na atualização: " . $mysqli->error);
    }
} else {
    // Se não for uma solicitação POST, redirecionar para a lista de produtos
    header("Location: ../adminPainel.php?aqua=dashboardAdmin&section=listProdutos");
    exit();
}
?>