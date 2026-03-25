<?php

require_once "config/Database.php";

require_once "classes/Cliente.php";

class ClienteDAO {

    private $conn;

    public function __construct() {

        $database = new Database();

        $this->conn = $database->getConnection();
    }

public function excluir($id) {

    $sql = "DELETE FROM clientes WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":id", $id);

    return $stmt->execute();
}

    public function listarN() {

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

public function listar() {

        $sql = "SELECT * FROM clientes ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdN($id) {

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
public function buscarPorId($id) {

    $sql = "SELECT * FROM clientes WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        return new Cliente($dados['id'], $dados['nome'], $dados['email']);
    }

    return null;
}

    public function inserir(Cliente $cliente) {

        $sql = "INSERT INTO clientes (nome, email)
                VALUES (:nome, :email)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":nome", $cliente->getNome());
        $stmt->bindValue(":email", $cliente->getEmail());

        return $stmt->execute();
    }

    // ATUALIZAR CLIENTE
public function atualizar(Cliente $cliente) {

    $sql = "UPDATE clientes
            SET nome = :nome, email = :email
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(":nome", $cliente->getNome());
    $stmt->bindValue(":email", $cliente->getEmail());
    $stmt->bindValue(":id", $cliente->getId());

    return $stmt->execute();
}
}