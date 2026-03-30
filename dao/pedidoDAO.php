<?php

require_once "config/Database.php";
require_once "dao/ClienteDAO.php";

class PedidoDAO {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    
public function buscarPorId($id) {

    $sql = "SELECT * FROM pedidos WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {

        $clienteDAO = new ClienteDAO();
        $cliente = $clienteDAO->buscarPorId($dados['cliente_id']);

        return new Pedido($dados['id'], $cliente);
    }

    return null;
}

public function buscarProdutosPorPedido($pedidoId) {

    $sql = "SELECT produto_id FROM pedido_produtos WHERE pedido_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$pedidoId]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

public function atualizarProdutos($pedidoId, $produtos) {

    // Remove os antigos
    $sql = "DELETE FROM pedido_produtos WHERE pedido_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$pedidoId]);

    // Insere os novos
    foreach ($produtos as $produtoId) {

        $sql = "INSERT INTO pedido_produtos (pedido_id, produto_id)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pedidoId, $produtoId]);
    }
}

public function excluir($id) {

    // 1. Remove os produtos do pedido
    $sql = "DELETE FROM pedido_produtos WHERE pedido_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);

    // 2. Remove o pedido
    $sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$id]);
}
    
public function atualizar($pedido) {

    $sql = "UPDATE pedidos SET cliente_id = ? WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
    $pedido->getCliente()->getId(),
    $pedido->getId()
]);
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