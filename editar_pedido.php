<?php

require_once "dao/PedidoDAO.php";
require_once "classes/Pedido.php";
require_once "dao/ClienteDAO.php";
require_once "dao/ProdutoDAO.php";

$produtoDAO = new ProdutoDAO();
$listaProdutos = $produtoDAO->listar();

$pedidoDAO = new PedidoDAO();

// Buscar pedido
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pedido = $pedidoDAO->buscarPorId($id);
    $produtosSelecionados = $pedidoDAO->buscarProdutosPorPedido($id);
}

// Atualizar
if (isset($_POST['atualizar'])) {

    $id = $_POST['id'];
    $cliente_id = $_POST['cliente_id'];
    $produtos = $_POST['produtos'] ?? [];

    // cria o DAO do cliente
    $clienteDAO = new ClienteDAO();

    // busca o cliente como objeto
    $cliente = $clienteDAO->buscarPorId($cliente_id);

    // cria o pedido corretamente
    $pedidoAtualizado = new Pedido($id, $cliente);

    if ($pedidoDAO->atualizar($pedidoAtualizado)) {

    // atualiza os produtos do pedido
    $pedidoDAO->atualizarProdutos($id, $produtos);

    echo "<h1>Pedido atualizado com sucesso!</h1>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "<h1>Erro ao atualizar!</h1>";
    }
}
?>

<h2>Editar Pedido</h2>

<form method="POST">

    <input type="hidden" name="id" value="<?= $pedido->getId(); ?>">

    Cliente ID:<br>
    <input type="text" name="cliente_id" value="<?= $pedido->getCliente()->getId(); ?>"><br><br>

    Produtos:<br>
    <select name="produtos[]" multiple>
    <?php foreach ($listaProdutos as $produto): ?>
        <option value="<?= $produto['id']; ?>"
            <?= in_array($produto['id'], $produtosSelecionados) ? 'selected' : '' ?>>
            <?= $produto['nome']; ?>
        </option>
    <?php endforeach; ?>
</select>

    <br><br>
    <button type="submit" name="atualizar">Atualizar</button>
</form>
<head>
<link rel="stylesheet" href="./style.css">
<link rel="icon" href="./assets/edit.png">
</head>