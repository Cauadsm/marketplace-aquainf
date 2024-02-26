<?php
require_once '../conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    // Processar a imagem em base64
    $imagem_base64 = '';
    if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])) {
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_base64 = base64_encode(file_get_contents($imagem_tmp));
    }


} else {
    echo "Erro ao processar requisição POST";
    exit();
}
try {
    // Inserir no banco de dados usando MySQLi
    try {
        $stmt = $mysqli->prepare("INSERT INTO produtos (nome, preco, imagem_base64, descricao) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $nome, $preco, $imagem_base64, $descricao);
        $stmt->execute();

        echo "Produto cadastrado com sucesso!";
    } catch (\Exception $e) {
        echo "Erro ao cadastrar produto: " . $e->getMessage();
    }
    // Redirecionar de volta à tela anterior
    header('Location: ../adminPainel.php?aqua=dashboardAdmin&section=addProdutos');
    exit(); 
} catch (\Exception $e) {
    echo "Erro ao cadastrar produto: " . $e->getMessage();
}
?>
