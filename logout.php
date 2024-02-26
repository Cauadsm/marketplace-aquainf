<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    session_destroy();

    header("Location: index.php"); // Redireciona para o index.php (login)
?>