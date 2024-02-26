<?php
require_once '../conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $mysqli->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Produto excluído com sucesso
        $stmt->close(); 
        $mysqli->close(); 
        header("Location: ../adminPainel.php?aqua=dashboardAdmin&section=listProdutos"); // Redireciona para a página de lista após a exclusão
        exit();
    } else {
        // Erro ao excluir o produto
        die("Erro ao excluir o produto: " . $stmt->error);
    }

} else {
    // ID inválido
    die("ID de produto inválido.");
}

?>
