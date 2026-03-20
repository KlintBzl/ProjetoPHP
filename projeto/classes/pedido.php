<?php

class Pedido {
    private $numero;
    private $cliente;
    private $produtos = [];

    public function __construct($numero, Cliente $cliente) {
        $this->numero = $numero;
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
        echo "<h3>Pedido #{$this->numero}</h3>";
        echo "Cliente: " . $this->cliente->getNome() . "<br><br>";

        echo "Produtos:<br>";
        foreach ($this->produtos as $produto) {
            echo "- " . $produto->getNome() . " | R$ " . $produto->getPreco() . "<br>";
        }

        echo "<br>Total: R$ " . $this->calcularTotal();
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente($cliente) {
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