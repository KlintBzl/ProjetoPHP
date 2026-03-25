# Sistema de Pedidos em PHP

Este projeto é um sistema simples de gerenciamento de pedidos, desenvolvido em PHP utilizando Programação Orientada a Objetos (POO) e banco de dados MySQL.

---

## Funcionalidades

- ✅ Cadastro de clientes
- ✅ Cadastro de produtos
- ✅ Criação de pedidos
- ✅ Associação de clientes aos pedidos
- ✅ Seleção de múltiplos produtos por pedido
- ✅ Cálculo automático do total do pedido

---

## Estrutura do Projeto




---

##  Conceitos Utilizados

- Programação Orientada a Objetos (POO)
- Encapsulamento (getters e setters)
- DAO (Data Access Object)
- PDO para conexão com banco de dados
- Relacionamento entre entidades (Cliente, Produto e Pedido)

---

##  Banco de Dados

###  Tabela `clientes`

```sql
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100)
);
```
###  Tabela `produtos`

```sql
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    preco DECIMAL(10,2)
);
```
###  Tabela `pedidos`

```sql
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT,
    cliente_id INT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
```
###  Tabela `pedidos`(relacionamento)

```sql
CREATE TABLE pedido_produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    produto_id INT,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
```

## Como Executar o Projeto

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-repo.git
   ```
2. Coloque o projeto dentro da pasta htdocs (XAMPP)
3. Inicie o Apache e MySQL no XAMPP
4. Crie o banco de dados no phpMyAdmin
5. Execute os scripts SQL acima
6. Acesse no navegador:
http://localhost/projeto/index.php

## Interface

O sistema possui três áreas principais:

- Cadastro de Clientes  
- Cadastro de Produtos  
- Cadastro de Pedidos  

---

## Observações

- O número do pedido é gerado automaticamente  
- É necessário cadastrar clientes e produtos antes de criar pedidos  
- O sistema ainda não possui edição ou exclusão de dados  

---

## Melhorias Futuras

- Editar e excluir registros  
- Listagem de pedidos  
- Exibição do total por pedido  
- Sistema de login  
- Interface com CSS/Bootstrap  

---

##  Autor

Klint Burzlaff Berta Lemes - 17anos
Projeto desenvolvido para fins de estudo de PHP e POO.

---

## Licença

Uso livre para fins educacionais.
