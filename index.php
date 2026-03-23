<link rel="stylesheet" href="./style.css">

<div class="container">

<div class="card">
    <?php

// Importações
require_once "dao/clienteDAO.php";
require_once "dao/pedidoDAO.php";
require_once "dao/produtoDAO.php";
require_once "classes/cliente.php";
require_once "classes/pedido.php";
require_once "classes/produto.php";

// Cria objeto DAO
$clienteDAO = new ClienteDAO();

if(isset($_POST['salvarCli'])) {

    $nome = $_POST['nomeCli'];
    $email = $_POST['emailCli'];

    $cliente = new Cliente(null, $nome, $email);

    if($clienteDAO->inserir($cliente)) {
        echo "Cliente cadastrado com sucesso!<br>";
    } else {
        echo "Erro ao cadastrar!<br>";
    }
}
?>

<h2>Cadastro de Clientes</h2>

<form method="POST">

    Nome: <br>
    <input type="text" name="nomeCli" required><br><br>

    Email: <br>
    <input type="email" name="emailCli" required><br><br>

    <button type="submit" name="salvarCli">Salvar</button>

</form>
</div>

<div class="card">
    <?php

// Cria objeto DAO
$produtoDAO = new ProdutoDAO();

if(isset($_POST['salvarPro'])) {

    $nome = $_POST['nomePro'];
    $preco = $_POST['precoPro'];

    $produto = new Produto(null, $nome, $preco);

    if($produtoDAO->inserir($produto)) {
        echo "Produto cadastrado com sucesso!<br>";
    } else {
        echo "Erro ao cadastrar!<br>";
    }
}
?>

<h2>Cadastro de Produtos</h2>

<form method="POST">

    Nome: <br>
    <input type="text" name="nomePro" required><br><br>

    Preço: <br>
    <input type="number" name="precoPro" required><br><br>

    <button type="submit" name="salvarPro">Salvar</button>

</form>
</div>

<div class="card">
    <?php 

$pedidoDAO = new PedidoDAO();
$clientes = $clienteDAO->listar();
$produtos = $produtoDAO->listar();

if(isset($_POST['salvarPed'])) {

    $cli = $_POST['cliPed'];
    $produtosSelecionados = $_POST['produtos'] ?? [];

    // busca cliente
    $cliente = $clienteDAO->buscarPorId($cli);

    if(!$cliente) {
        echo "Cliente não encontrado!<br>";
        exit;
    }


    $pedido = new Pedido($cliente);

    // adiciona SOMENTE os produtos marcados
    foreach($produtosSelecionados as $idProduto) {
        $produto = $produtoDAO->buscarPorId($idProduto);

        if($produto) {
            $pedido->adicionarProduto($produto);
        }
    }

    // valida se escolheu produto
    if(empty($pedido->getProdutos())) {
        echo "Selecione pelo menos um produto!<br>";
        exit;
    }

    // salva
    if($pedidoDAO->inserir($pedido)) {
        echo "Pedido cadastrado com sucesso!<br>";
    } else {
        echo "Erro ao cadastrar!<br>";
    }
}
?>

<h2>Cadastro de Pedidos</h2>

<form method="POST">

    Cliente: <br>
    <select name="cliPed">
        <?php foreach($clientes as $c): ?>
            <option value="<?= $c->getId() ?>">
                <?= $c->getNome() ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    Produtos: <br>

    <?php foreach($produtos as $p): ?>
        <input type="checkbox" name="produtos[]" value="<?= $p->getId() ?>">
        <?= $p->getNome() ?> (R$ <?= $p->getPreco() ?>)
        <br>
    <?php endforeach; ?>

    <br>

    <button type="submit" name="salvarPed">Salvar</button>

</form>

<?php 

$dados = $pedidoDAO->listarComProdutos();

$pedidos = [];

foreach($dados as $linha) {

    $id = $linha['pedido_id'];

    if(!isset($pedidos[$id])) {
        $pedidos[$id] = [
            'cliente' => $linha['cliente_nome'],
            'produtos' => []
        ];
    }

    $pedidos[$id]['produtos'][] = [
        'nome' => $linha['produto_nome'],
        'preco' => $linha['preco']
    ];
}

echo "<h2>Pedidos cadastrados</h2>";

foreach($pedidos as $id => $pedido) {

    echo "<div class='pedido'>";
    echo "<h3>Pedido #$id</h3>";
    echo "<strong>Cliente:</strong> " . $pedido['cliente'] . "<br><br>";

    echo "<strong>Produtos:</strong><br>";

    foreach($pedido['produtos'] as $produto) {
        echo "- {$produto['nome']} (R$ {$produto['preco']})<br>";
    }

    echo "<hr>";
    echo "</div>";
}

?>
</div>

</div>