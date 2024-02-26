<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $acesso = $_POST['acesso'];

    // Atualize os dados no banco de dados
    $query = "UPDATE usuario SET nome='$nome', email='$email', senha='$senha', cpf='$cpf', acesso='$acesso' WHERE id=$id";
    $result = $mysqli->query($query);

    if ($result) {
        // Sucesso na atualização
        header("Location: ../adminPainel.php?aqua=dashboardAdmin&section=listUsers"); // Redirecione para a lista de usuários
        exit();
    } else {
        // Erro na atualização
        die("Erro na atualização: " . $mysqli->error);
    }
} else {
    // Se não for uma solicitação POST, redirecione para a lista de usuários
    header("Location: ../adminPainel.php?aqua=dashboardAdmin&section=listUsers");
    exit();
}
?>