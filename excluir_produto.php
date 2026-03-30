<?php

require_once "dao/produtoDAO.php";

$produtoDAO = new produtoDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($produtoDAO->excluir($id)) {
        echo "Produto excluído com sucesso!<br><br>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "Erro ao excluir produto!";
    }
}
?>
