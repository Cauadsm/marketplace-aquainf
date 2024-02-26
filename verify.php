<?php
require 'crud-user.php';



if (isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])){

    require_once 'crud-user.php'; //Chamar uma vez
    $u = new User("aquainf","localhost","root","");

    $listLoggedUser = $u->loggedUser($_SESSION['id_usuario']);
    $nomeUser = $listLoggedUser['nome'];
    $emailUser = $listLoggedUser['email'];
    $cpfUser = $listLoggedUser['cpf'];
    $acessoUser = $listLoggedUser['acesso'];

}else{
    header("Location: index.php");
}
?>