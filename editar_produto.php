<?php

require_once "dao/produtoDAO.php";
require_once "classes/produto.php";

$produtoDAO = new produtoDAO();

// Verifica se o ID foi enviado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produto = $produtoDAO->buscarPorId($id);
}

// Verifica se o formulário de atualização foi enviado
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    $produtoAtualizado = new produto($id, $nome, $preco);

    if ($produtoDAO->atualizar($produtoAtualizado)) {
        echo "Produto atualizado com sucesso!<br><br>";
        header("refresh:2;url=index.php");
        exit;
    } else {
        echo "Erro ao atualizar produto!";
    }
}
?>

<h2>Editar produto</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $produto->getId(); ?>">

    Nome: <br>
    <input type="text" name="nome" value="<?= $produto->getNome(); ?>" required><br><br>

    Preço: <br>
    <input type="number" name="preco" value="<?= $produto->getPreco(); ?>" required><br><br>

    <button type="submit" name="atualizar">Atualizar</button>
</form>