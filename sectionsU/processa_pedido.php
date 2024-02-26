<?php
require_once '../crud-user.php';

// Verificar se o usuário está autenticado
if (isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])) {
    // Verificar se os dados do formulário foram enviados
    if (isset($_GET['id']) && isset($_GET['quantidade'])) {
        // Obter dados do formulário
        $produto_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $quantidade = filter_var($_GET['quantidade'], FILTER_VALIDATE_INT);

        if ($produto_id !== false && $quantidade !== false) {
            // Obter o ID do usuário da sessão
            $usuario_id = $_SESSION['id_usuario'];

            // Incluir o arquivo de conexão com o banco de dados
            require_once '../conexao.php';

            // Verificar se a conexão foi bem-sucedida
            if ($mysqli->connect_error) {
                die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
            }

            // Preparar a declaração SQL para obter informações do produto
            $sql_produto = $mysqli->prepare("SELECT nome, preco, imagem_base64 FROM produtos WHERE id = ?");

            // Verificar se a preparação da consulta foi bem-sucedida
            if ($sql_produto) {
                // Vincular os parâmetros e executar a consulta
                $sql_produto->bind_param("i", $produto_id);

                if ($sql_produto->execute()) {
                    // Vincular as variáveis aos resultados da consulta
                    $sql_produto->bind_result($produto_nome, $produto_valor, $produto_imagem_base64);

                    // Obter os resultados
                    $sql_produto->fetch();

                    // Fechar a declaração
                    $sql_produto->close();

                    // Preparar a declaração SQL para inserir o pedido
                    $sql_pedido = $mysqli->prepare("INSERT INTO pedidos (usuario_id, produto_id, quantidade, produto_nome, produto_valor, produto_imagem_base64) VALUES (?, ?, ?, ?, ?, ?)");

                    // Verificar se a preparação da consulta foi bem-sucedida
                    if ($sql_pedido) {
                        // Vincular os parâmetros e executar a consulta
                        $sql_pedido->bind_param("iiisds", $usuario_id, $produto_id, $quantidade, $produto_nome, $produto_valor, $produto_imagem_base64);

                        if ($sql_pedido->execute()) {
                            // Fechar a declaração
                            $sql_pedido->close();

                            // Fechar a conexão
                            $mysqli->close();

                            echo "Pedido inserido com sucesso!";
                            header("Location: {$_SERVER['HTTP_REFERER']}");
                            exit();
                        } else {
                            echo "Erro ao inserir pedido: " . $sql_pedido->error;
                        }

                        // Fechar a declaração
                        $sql_pedido->close();
                    } else {
                        echo "Erro na preparação da declaração SQL para pedido.";
                    }
                } else {
                    echo "Erro ao obter informações do produto: " . $sql_produto->error;
                }

                // Fechar a declaração
                $sql_produto->close();
            } else {
                echo "Erro na preparação da declaração SQL para informações do produto.";
            }

            // Fechar a conexão
            $mysqli->close();
        } else {
            echo "Dados do formulário inválidos.";
        }
    } else {
        echo "Dados do formulário ausentes.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>