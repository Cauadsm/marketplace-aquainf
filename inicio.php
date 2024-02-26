<?php
require_once 'conexao.php'; 

// Consultar produtos no banco de dados
$query = "SELECT id, nome, preco, imagem_base64, descricao FROM produtos";
$result = $mysqli->query($query);

if (!$result) {
    die("Erro na consulta: " . $mysqli->error);
}
?>

<h2 class="section">Destaques:</h2>

<div class="d-flex justify-content-start">
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="card" style="width: 18rem; margin-right: 10px;">
            <img class="card-img-top" style="max-width: 300px; max-height: 300px;"
                src='data:image;base64,<?php echo $row['imagem_base64']; ?>' alt="Imagem de capa do card">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $row['nome']; ?>
                </h5>
                <p class="card-text" style="color: green; font-weight: bolder;">Preço: R$
                    <?php echo number_format($row['preco'], 2, ',', '.'); ?>
                </p>
                <a href="sectionsU\processa_pedido.php?id=<?php echo $row['id']; ?>&quantidade=1" class="btn btn-primary">Comprar</a>

            </div>
        </div>

        <?php
    }
    ?>
</div>