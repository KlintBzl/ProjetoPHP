<?php 

class Pedido {
    private $id;
    private $cliente;
    private $produtos = [];

    public function __construct($id, Cliente $cliente) {
        $this->id = $id;
        $this->cliente = $cliente;
    }

    public function adicionarProduto(Produto $produto) {
        $this->produtos[] = $produto;
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->produtos as $produto) {
            $total += $produto->getPreco();
        }
        return $total;
    }

    public function exibirResumo() {
        echo "Cliente: " . $this->cliente->getNome() . "<br><br>";

        echo "Produtos:<br>";
        foreach ($this->produtos as $produto) {
            echo "- " . $produto->getNome() . " | R$ " . $produto->getPreco() . "<br>";
        }

        echo "<br>Total: R$ " . $this->calcularTotal();
    }

    // GETTERS E SETTERS

    public function getId() {
        return $this->id;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    public function getProdutos() {
        return $this->produtos;
    }

    public function setProdutos($produtos) {
        $this->produtos = $produtos;
    }
}

?>