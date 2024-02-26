<style>
    :root {
        --bg-nav: #2e2e2e;
        --primary-color: #b57aec;
        --secondary-color: #912cf0;
    }

    .btn-secondary {
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-secondary:hover {
        color: #fff;
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }
</style>

<div class="container">
    <div class="row">
        <!-- Seção de Botões -->
        <div class="col-3">
            <section class="section">
                <div class="btn-group-vertical" role="group" aria-label="Grupo de botões com dropdown aninhado">
                    <a href="adminPainel.php?aqua=dashboardAdmin&section=minhaConta" class="btn btn-secondary">Minha
                        Conta</a>
                    <a href="adminPainel.php?aqua=dashboardAdmin&section=addProdutos"
                        class="btn btn-secondary">Adicionar Produto</a>
                    <a href="adminPainel.php?aqua=dashboardAdmin&section=listProdutos" class="btn btn-secondary">Lista
                        de Produtos</a>
                    <a href="adminPainel.php?aqua=dashboardAdmin&section=listUsers" class="btn btn-secondary">Lista de
                        Usuários</a>
                </div>
            </section>
        </div>

        <!-- Seção de Conteúdo Dinâmico -->
        <div class="col">
            <section>
                <?php
                // Obter o valor do parâmetro 'section' da URL
                $section = isset($_GET['section']) ? $_GET['section'] : '';

                // Determinar qual conteúdo exibir com base no valor do parâmetro 'section'
                switch ($section) {
                    case 'minhaConta':
                        include 'sections/minhaConta.php';
                        break;
                    case 'addProdutos':
                        include 'sections/addProdutos.php';
                        break;
                    case 'listProdutos':
                        include 'sections/listProdutos.php';
                        break;
                    case 'listUsers':
                        include 'sections/listUsers.php';
                        break;
                    default:
                        // Incluir um conteúdo padrão ou exibir uma mensagem de erro, se necessário
                        include 'sections/minhaConta.php';
                        break;
                }
                ?>
            </section>
        </div>
    </div>
</div>