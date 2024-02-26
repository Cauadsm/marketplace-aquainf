<?php
require_once 'crud-user.php';
include 'PDO.php';

$teste = new usePDO();
$teste->createDB();
$teste->createTable();
$teste->createTableProdutos();
$teste->createTablePedidos();


$u = new User("aquainf", "localhost", "root", "");

if (isset($_POST['email'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['c-senha']);
    $cpf = addslashes($_POST['cpf']);

    //Verificar se a senha e confirmar senha estao iguais
    if ($senha != $confirmarSenha) {
        
    } else {
        if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
            if ($u->registerUser($nome, $email, $senha, $cpf)) {
                header("Location: index.php");
            }

        } else {
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <section class="vh-100" style="background-color: #b57aec;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="img/svg/animation.svg" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0"><img style="width: 50px; height: 50px"
                                                    src="img/icon.png" alt=""></span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Crie sua conta</h5>
                                        <div class="form-outline mb-4">

                                            <input name="nome" type="text" id="form2Example17"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Nome Completo</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input name="email" type="email" id="form2Example17"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Endereço de Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input name="senha" type="password" id="form2Example27"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Senha</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input name="c-senha" type="password" id="form2Example27"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Confirmar - Senha</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input name="cpf" type="number" id="form2Example27"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">CPF</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Registrar</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Já tem uma conta? <a
                                                href="index.php" style="color: #393f81;">Logue aqui</a></p>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>