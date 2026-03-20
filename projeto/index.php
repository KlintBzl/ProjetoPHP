<?php

require_once "classes/Cliente.php";
require_once "classes/Produto.php";
require_once "classes/Pedido.php";

// Cliente
$cliente = new Cliente(1, "João Silva", "joao@email.com");

// Produtos
$p1 = new Produto(1, "Notebook", 3500);
$p2 = new Produto(2, "Mouse Gamer", 150);
$p3 = new Produto(3, "Headset", 280);

// Pedido
$pedido = new Pedido(1001, $cliente);
$pedido->adicionarProduto($p1);
$pedido->adicionarProduto($p2);
$pedido->adicionarProduto($p3);

$total = $pedido->calcularTotal();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="./assets/fotinha.png">
    <title>Sistema de Pedidos</title>
</head>
<body>

<div class="container">

    <h1>Sistema de Pedidos da Loja</h1>

    <div class="section">
        <h2>Pedido Nº <?php echo $pedido->getNumero(); ?></h2>
    </div>

    <div class="section">
        <h2>Cliente</h2>
        <p><?php echo $cliente->getNome(); ?></p>
        <p><?php echo $cliente->getEmail(); ?></p>
    </div>

    <div class="section">
        <h2>Produtos</h2>

        <?php foreach ($pedido->getProdutos() as $produto): ?>
            <div class="produto">
                <span><?php echo $produto->getNome(); ?></span>
                <span>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></span>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="section total">
        Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
    </div>

</div>

</body>
</html>