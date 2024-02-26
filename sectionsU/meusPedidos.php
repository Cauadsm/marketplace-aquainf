<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
</head>

<body>

    <?php
    require_once 'conexao.php';

    if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
        header("Location: index.php");
        exit();
    }

    // Obter o ID do usuário da sessão
    $usuario_id = $_SESSION['id_usuario'];

    // Consulta SQL para obter os pedidos do usuário
    $sql = "SELECT id, produto_nome, produto_valor, quantidade, data_pedido, produto_imagem_base64
        FROM pedidos
        WHERE usuario_id = ?
        ORDER BY data_pedido DESC";

    // Preparar a declaração SQL
    $stmt = $mysqli->prepare($sql);

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincular os parâmetros e executar a consulta
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();

        // Vincular as variáveis aos resultados da consulta
        $stmt->bind_result($pedido_id, $produto_nome, $produto_valor, $quantidade, $data_pedido, $produto_imagem_base64);

        // Exibir a lista de pedidos com layout ajustado
        echo "<div class='container mt-4'>";
        echo "<div class='row'>";
        while ($stmt->fetch()) {
            echo "<div class='col-md-6 mb-4'>";
            echo "<div class='card'>";
            echo "<img src='data:image/jpeg;base64," . $produto_imagem_base64 . "' alt='Imagem do Produto' class='card-img-top' style='max-width: 100px; max-height: 100px;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Pedido #$pedido_id</h5>";
            echo "<p class='card-text'>Produto: $produto_nome</p>";
            echo "<p class='card-text'>Valor: $produto_valor</p>";
            echo "<p class='card-text'>Quantidade: $quantidade</p>";
            echo "<p class='card-text'>Data do Pedido: $data_pedido</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da declaração SQL para listar os pedidos.";
    }

    // Fechar a conexão
    $mysqli->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
