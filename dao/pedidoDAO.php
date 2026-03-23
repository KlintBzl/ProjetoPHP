<?php

require_once "config/Database.php";

class PedidoDAO {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function listarComProdutos() {

        $sql = "SELECT 
                    p.id as pedido_id,
                    c.nome as cliente_nome,
                    pr.id as produto_id,
                    pr.nome as produto_nome,
                    pr.preco
                FROM pedidos p
                JOIN clientes c ON c.id = p.cliente_id
                JOIN pedido_produtos pp ON pp.pedido_id = p.id
                JOIN produtos pr ON pr.id = pp.produto_id
                ORDER BY p.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function inserir(Pedido $pedido) {

        // 1. Salva pedido
        $sql = "INSERT INTO pedidos (cliente_id)
                VALUES (:cliente_id)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":cliente_id", $pedido->getCliente()->getId());

        $stmt->execute();

        // pega o ID do pedido criado
        $pedidoId = $this->conn->lastInsertId();

        // 2. Salva produtos do pedido
        foreach ($pedido->getProdutos() as $produto) {

            $sql = "INSERT INTO pedido_produtos (pedido_id, produto_id)
                    VALUES (:pedido_id, :produto_id)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":pedido_id", $pedidoId);
            $stmt->bindValue(":produto_id", $produto->getId());

            $stmt->execute();
        }

        return true;
    }
}