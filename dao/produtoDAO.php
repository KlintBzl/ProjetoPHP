<?php

// Importa conexão
require_once "config/Database.php";

// Importa model
require_once "classes/produto.php";

class produtoDAO {

    // Atributo que armazenará a conexão
    private $conn;

    // Construtor cria conexão automaticamente
    public function __construct() {

        // Instancia Database
        $database = new Database();

        // Obtém conexão
        $this->conn = $database->getConnection();
    }

    public function buscarPorId($id) {

    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if($dados) {
        return new Produto(
            $dados['id'],
            $dados['nome'],
            $dados['preco']
        );
    }

    return null;
    }

    public function listar() {
    $sql = "SELECT * FROM produtos";
    $stmt = $this->conn->query($sql);

    $produtos = [];

    while($row = $stmt->fetch()) {
        $produtos[] = new Produto($row['id'], $row['nome'], $row['preco']);
    }

    return $produtos;
    }

    // Método responsável por inserir dados
    public function inserir(produto $produto) {

        // SQL com parâmetros nomeados
        $sql = "INSERT INTO produtos (nome, preco)
                VALUES (:nome, :preco)";

        // Prepara a query
        $stmt = $this->conn->prepare($sql);

        // Associa valores aos parâmetros
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":preco", $produto->getPreco());

        // Executa e retorna verdadeiro ou falso
        return $stmt->execute();
    }
}