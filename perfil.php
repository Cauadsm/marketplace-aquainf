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

<div class="container ">
    <div class="row">
        <div class="col-3">
            <section class="section">
                <div class="btn-group-vertical" role="group" aria-label="Grupo de botões com dropdown aninhado">
                    <a type="button" class="btn btn-secondary" href="Painel.php?aqua=perfil&sectionsU=minhaContaUser">Minha Conta</a>
                    <a type="button" class="btn btn-secondary" href="Painel.php?aqua=perfil&sectionsU=meusPedidos">Meus Pedidos</a>
                    <a type="button" class="btn btn-secondary" href="Painel.php?aqua=perfil&sectionsU=enderecoCadastrados">Endereços Cadastrados</a>

                </div>
            </section>
        </div>


        <!-- Seção de Conteúdo Dinâmico -->
        <div class="col">
            <section>
                <?php
                // Obter o valor do parâmetro 'section' da URL
                $sectionsU = isset($_GET['sectionsU']) ? $_GET['sectionsU'] : '';

                // Determinar qual conteúdo exibir com base no valor do parâmetro 'section'
                switch ($sectionsU) {
                    case 'minhaContaUser':
                        include 'sectionsU/minhaContaUser.php';
                        break;
                    case 'meusPedidos':
                        include 'sectionsU/meusPedidos.php';
                        break;
                    case 'enderecoCadastrados':
                        include 'sectionsU/enderecoCadastrados.php';
                        break;
                    default:
                        // Incluir um conteúdo padrão ou exibir uma mensagem de erro, se necessário
                        include 'sectionsU/minhaContaUser.php';
                        break;
                }
                ?>
            </section>
        </div>
    </div>

    <?php


    ?>