<?php

require_once "dao/ClienteDAO.php";

$clienteDAO = new ClienteDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($clienteDAO->excluir($id)) {
        echo "Cliente excluído com sucesso!<br><br>";
        header("refresh:2;url=clientes.php");
        exit;
    } else {
        echo "Erro ao excluir cliente!";
    }
}
?>

<html>
    <button href="./index.php">Voltar</button>
</html>