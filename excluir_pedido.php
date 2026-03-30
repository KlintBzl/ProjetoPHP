<?php

require_once "dao/PedidoDAO.php";

$pedidoDAO = new PedidoDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($pedidoDAO->excluir($id)) {
        echo "Pedido excluído com sucesso!<br><br>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "Erro ao excluir pedido!";
    }
}
?>