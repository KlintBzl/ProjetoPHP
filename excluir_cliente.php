<?php

require_once "dao/ClienteDAO.php";

$clienteDAO = new ClienteDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($clienteDAO->excluir($id)) {
        echo "<h1>Cliente excluído com sucesso!</h1><br><br>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "<h1>Erro ao excluir cliente!</h1>";
    }
}
?>
<head>
<link rel="stylesheet" href="./style.css">
<link rel="icon" href="./assets/delete.png">
</head>