<?php

require_once "dao/produtoDAO.php";

$produtoDAO = new produtoDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($produtoDAO->excluir($id)) {
        echo "<h1>Produto excluído com sucesso!</h1><br><br>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "<h1>Erro ao excluir produto!</h1>";
    }
}
?>
<head>
<link rel="stylesheet" href="./style.css">
<link rel="icon" href="./assets/delete.png">
</head>