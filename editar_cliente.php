<?php

require_once "dao/clienteDAO.php";
require_once "classes/cliente.php";

$clienteDAO = new ClienteDAO();

// Verifica se o ID foi enviado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cliente = $clienteDAO->buscarPorId($id);
}

// Verifica se o formulário de atualização foi enviado
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $clienteAtualizado = new Cliente($id, $nome, $email);

    if ($clienteDAO->atualizar($clienteAtualizado)) {
        echo "Cliente atualizado com sucesso!<br><br>";
        header("refresh:2;url=clientes.php");
        exit;
    } else {
        echo "Erro ao atualizar cliente!";
    }
}
?>

<h2>Editar Cliente</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $cliente->getId(); ?>">

    Nome: <br>
    <input type="text" name="nome" value="<?= $cliente->getNome(); ?>" required><br><br>

    Email: <br>
    <input type="email" name="email" value="<?= $cliente->getEmail(); ?>" required><br><br>

    <button type="submit" name="atualizar">Atualizar</button>
</form>