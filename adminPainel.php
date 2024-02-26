<?php
require 'verify.php';



if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Usuário não é um administrador
    header("Location: painel.php");
    exit();
}


if (isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])): ?>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel de Administrador</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/painel.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    </head>


    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand font " href="adminPainel.php?aqua=inicio">
                    <img src="img/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Aqua Informatica
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
                    aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse my-lg-4" id="conteudoNavbarSuportado">
                    <div class="dropdown">
                        <button class="btn color-theme dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Departamentos
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Hardware</a>
                            <a class="dropdown-item" href="#">Periféricos</a>
                            <a class="dropdown-item" href="#">Computadores</a>
                            <a class="dropdown-item" href="#">Kit Upgrade</a>
                            <a class="dropdown-item" href="#">Monitores</a>
                            <a class="dropdown-item" href="#">Cadeiras e Mesas Gamers</a>
                        </div>
                    </div>
                </div>

                <form class="form-inline my-2 my-lg-0">

                    <div class="collapse navbar-collapse my-lg-4" id="conteudoNavbarSuportado">
                        <div class="dropdown">
                            <button class="btn color-theme dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Minha conta
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="adminPainel.php?aqua=dashboardAdmin">Dashboard Admin</a>
                                <a class="dropdown-item" href="adminPainel.php?aqua=configuracao">Configurações</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Desconectar</a>
                            </div>
                        </div>
                    </div>

                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </nav>
        </header>
        <main>
            <div class="banner ">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="img/1.png" alt="Primeiro Slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/2.png" alt="Segundo Slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/3.png" alt="Terceiro Slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
            </div>
            
            <div class="container-fluid"> 
               <?php
                    $aqua = "";
                    if (isset($_GET['aqua']) && !empty($_GET['aqua'])) {
                        $aqua = addslashes($_GET['aqua']);
                    }

                    switch ($aqua) {
                        case 'dashboardAdmin':
                            require 'dashboardAdmin.php';
                            break;
                        case 'configuracao':
                            require 'configuracao.php';
                            break;
                        default:
                            require 'inicio.php';
                            break;
                    }
                ?>


            </div>

        </main>



    </body>


    </html>


    
<?php else:
    header("Location: index.php");
endif ?>