# Sistema de Pedidos em PHP

---

## Sobre o Projeto

Este projeto foi desenvolvido com o objetivo de aplicar conceitos de **Programação Orientada a Objetos (POO) em PHP**, além de boas práticas de organização de código, uso de HTML, CSS e responsividade.

O sistema simula o funcionamento básico de uma loja, permitindo o gerenciamento de pedidos de forma simples e organizada.

---

## Funcionalidades

-  Cadastro de cliente  
-  Cadastro de produtos  
-  Criação de pedido  
-  Adição de produtos ao pedido  
-  Cálculo automático do total  
-  Exibição de resumo do pedido  

---

##  Conceitos aplicados

- Classes e Objetos  
- Encapsulamento (`private`)  
- Getters e Setters  
- Construtor (`__construct`)  
- Relacionamento entre classes  
- Organização em múltiplos arquivos  
- Uso de `require_once`  

---

##  Estrutura do Projeto

projeto_loja/

│

├── index.php

├── style.css

├── README.md

│

└── classes/

├── Cliente.php

├── Produto.php

└── Pedido.php


---

##  Classes do Sistema

###  Cliente
- id  
- nome  
- email  

---

### Produto
- id  
- nome  
- preco  

✔ Possui validação para impedir preços negativos.

---

### Pedido
- numero  
- cliente (objeto Cliente)  
- produtos (array de Produto)  

### Métodos:
- adicionarProduto()  
- calcularTotal()  
- exibirResumo()  

---

## Interface

O sistema exibe:

- Título do sistema  
- Número do pedido  
- Dados do cliente  
- Lista de produtos  
- Total do pedido  

---

## Estilização

- Layout limpo e organizado  
- Cores suaves  
- Boa legibilidade  
- Uso de CSS externo  

---

## Responsividade

O sistema é responsivo e funciona em:

- Celulares  
- Computadores  

✔ Layout adaptável  
✔ Elementos ajustáveis  
✔ Texto legível em telas menores  

---

## Como executar o projeto

1. Clone este repositório:
https://github.com/KlintBzl/ProjetoPHP
2. Coloque a pasta em um servidor local (ex: XAMPP)

3. Acesse no navegador:
localhost/projeto/index.php

---

## Autor

Klint Burzlaff Berta Lemes - 17 anos
