<?php

 class Produto{

private $id;
private $nome;
private $preco;

    public function __construct($id, $nome, $preco){
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco){
    if ($preco < 0) {
            echo "Erro: preço não pode ser negativo! <br>";
        } else {
            $this->preco = $preco;
        }
}

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

}

?>


