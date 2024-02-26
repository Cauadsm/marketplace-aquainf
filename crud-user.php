<?php

//Iniciando a sessao
session_start();


//Variaveis banco de dados
class User
{


    //Conexao com o banco de dados
    public function __construct($dbname, $host, $user, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (PDOException $e) {
            echo "Erro com banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro generico: " . $e->getMessage();
            exit();
        }
    }

    //Funcao para cadastrar usuario
    public function registerUser($nome, $email, $senha, $cpf)
    {
        //Antes de cadastrar verificar se ja tem o email cadastrado
        $cmd = $this->pdo->prepare("SELECT id FROM usuario WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false; //ja esta cadastrado
        } else {
            //caso nao, Cadastrar
            $cmd = $this->pdo->prepare("INSERT INTO usuario(nome,email,senha,cpf) VALUES (:n,:e,:s,:c)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":s", $senha);
            $cmd->bindValue(":c", $cpf);
            $cmd->execute();
            return true; //tudo ok
        }
    }

    public function loginUser($email, $senha)
    {
        // Verificar se o email e a senha estão cadastrados
        $cmd = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
        $cmd->bindValue("email", $email);
        $cmd->bindValue("senha", $senha);
        $cmd->execute();

        // Verificar se existe uma linha correspondente no banco de dados
        if ($cmd->rowCount() > 0) {
            // Se uma linha for encontrada, obter os dados
            $dado = $cmd->fetch();

            // Definir o ID do usuário na sessão
            $_SESSION['id_usuario'] = $dado['id'];

            // Verificar o valor do campo 'acesso'
            $_SESSION['admin'] = ($dado['acesso'] == 1);

            return true; // Logado com sucesso
        } else {
            return false; // Não foi possível fazer login
        }
    }


    public function loggedUser($id)
    {
        $array = array();
        //buscar as informacoes do usuario
        $cmd = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
            $array = $cmd->fetch();
        }
        return $array;
    }

    function updateUser($id, $nome, $email, $senha, $cpf)
    {
        try {
            $cmd = $this->pdo->prepare("UPDATE usuario SET nome = :n, email = :e, senha = :s, cpf = :c WHERE id = :id");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":s", $senha);
            $cmd->bindValue(":c", $cpf);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>