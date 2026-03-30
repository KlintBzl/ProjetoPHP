<?php

require_once "dao/PedidoDAO.php";

$pedidoDAO = new PedidoDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($pedidoDAO->excluir($id)) {
        echo "<h1>Pedido excluído com sucesso!</h1><br><br>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "<h1>Erro ao excluir pedido!</h1>";
    }
}
?>
<head>
<link rel="stylesheet" href="./style.css">
<link rel="icon" href="./assets/delete.png">
</head>