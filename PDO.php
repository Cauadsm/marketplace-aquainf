<?php
class usePDO
{




	//Algumas variáveis com dados sobre o Banco. 
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "aquainf";
	private $instance; // instância de conexão, usada no Singleton

	// método que retorna a instância de conexão
	function getInstance()
	{
		if (empty($instance)) {
			$instance = $this->connection();
		}
		return $instance;
	}

	//método que cria a instância de conexão. 
	private function connection()
	{
		try {
			$conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password); //Criando um objeto PDO
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //atribuindo modo de erro do PDO.
			return $conn;
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage() . "<br>";
			if (strpos($e->getMessage(), "Unknown database 'aquainf'")) {
				echo "Conexão nula, criando o banco pela primeira vez" . "<br>";
				$conn = $this->createDB();
				return $conn;
			} else
				die("Connection failed: " . $e->getMessage() . "<br>");
		}
	}
	function createDB()
	{
		try {
			$cnx = new PDO("mysql:host=$this->servername", $this->username, $this->password);
			$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
			$cnx->exec($sql);
			return $cnx;
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
	}

	function createTable()
	{
		try {
			$cnx = $this->getInstance();
			$sql = "CREATE TABLE IF NOT EXISTS usuario (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				nome VARCHAR(150) NOT NULL,
				email VARCHAR(150) UNIQUE NOT NULL,
				senha TEXT NOT NULL,
                cpf VARCHAR(11) NOT NULL,
				acesso INT(1) NOT NULL DEFAULT 0
			)";
			$cnx->exec($sql);


			$sql2 = "INSERT INTO usuario (nome, email, senha, cpf, acesso) VALUES ('Administrador Padrão', 'admin@admin', 'admin', '00000000000', 1) ";
			$cnx->exec($sql2);

		} catch (PDOException $e) {

		}
	}

	function createTableProdutos()
	{
		try {
			$cnx = $this->getInstance();
			$sql = "CREATE TABLE IF NOT EXISTS produtos (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				nome VARCHAR(150) NOT NULL,
				preco FLOAT(10,2) NOT NULL,
				descricao TEXT NOT NULL,
				imagem_base64 LONGTEXT NOT NULL
			)";
			$cnx->exec($sql);
		} catch (PDOException $e) {

		}
	}

	function createTablePedidos()
	{
		try {
			$cnx = $this->getInstance();
			$sql = "CREATE TABLE IF NOT EXISTS pedidos (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				usuario_id INT UNSIGNED,
				produto_id INT UNSIGNED,
				quantidade INT NOT NULL,
				data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				FOREIGN KEY (usuario_id) REFERENCES usuario(id),
				FOREIGN KEY (produto_id) REFERENCES produtos(id),
				produto_nome VARCHAR(150) NOT NULL,
				produto_valor FLOAT(10,2) NOT NULL,
				produto_imagem_base64 LONGTEXT NOT NULL
			)";
			$cnx->exec($sql);
		} catch (PDOException $e) {

		}
	}

}


?>