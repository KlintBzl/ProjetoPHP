<?php

// Importa conexão
require_once "config/Database.php";

// Importa model
require_once "classes/Cliente.php";

class ClienteDAO {

    // Atributo que armazenará a conexão
    private $conn;

    // Construtor cria conexão automaticamente
    public function __construct() {

        // Instancia Database
        $database = new Database();

        // Obtém conexão
        $this->conn = $database->getConnection();
    }

    public function listar() {

    $sql = "SELECT * FROM clientes";

    $stmt = $this->conn->query($sql);

    $clientes = [];

    while($row = $stmt->fetch()) {
        $clientes[] = new Cliente(
            $row['id'],
            $row['nome'],
            $row['email']
        );
    }

    return $clientes;
}

    public function buscarPorId($id) {

    $sql = "SELECT * FROM clientes WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $dados = $stmt->fetch();

    if(!$dados) {
        return null;
    }

    return new Cliente($dados['id'], $dados['nome'], $dados['email']);
}

    // Método responsável por inserir dados
    public function inserir(Cliente $cliente) {

        // SQL com parâmetros nomeados
        $sql = "INSERT INTO clientes (nome, email)
                VALUES (:nome, :email)";

        // Prepara a query
        $stmt = $this->conn->prepare($sql);

        // Associa valores aos parâmetros
        $stmt->bindValue(":nome", $cliente->getNome());
        $stmt->bindValue(":email", $cliente->getEmail());

        // Executa e retorna verdadeiro ou falso
        return $stmt->execute();
    }
}