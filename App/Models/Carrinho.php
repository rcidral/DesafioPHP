<?php

include_once '../App/Models/Model.php';

class Carrinho extends Model {
    private $id;
    private $id_usuario;
    private $id_produto;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __construct(\PDO $db) {
        parent::__construct($db);
    }

    public function listar() {
        $query = "SELECT id, id_usuario, id_produto FROM carrinho";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarCarrinhoUsuarioProdutos($id) {
        $query = "SELECT COUNT(id_produto) AS quantidade, carrinho.id, carrinho.id_usuario, carrinho.id_produto, produtos.nome, produtos.descricao, produtos.preco, produtos.img FROM carrinho INNER JOIN produtos ON carrinho.id_produto = produtos.id WHERE id_usuario = :id_usuario GROUP BY carrinho.id, carrinho.id_usuario, carrinho.id_produto, produtos.nome, produtos.descricao, produtos.preco, produtos.img";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPrecoCarrinho($id) {
        $query = "SELECT SUM(preco) AS preco FROM carrinho INNER JOIN produtos ON carrinho.id_produto = produtos.id WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function listarQuantidadeDeProdutos($id) {
        $query = "SELECT COUNT(id_produto) AS quantidade FROM carrinho WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function adicionarCarrinho() {
        for($i = 0; $i <= ($_REQUEST['quantidade'] -1 ); $i++) {
        $query = "INSERT INTO carrinho (id_usuario, id_produto) VALUES (:id_usuario, :id_produto)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':id_produto', $this->__get('id_produto'));
        $stmt->execute();
        }
    }
    public function limparCarrinho() {
        $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
    }
    public function removerItemCarrinho() {
        $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':id_produto', $this->__get('id_produto'));
        $stmt->execute();
    }
    public function finalizarCompra() {
        $query = "SELECT id_produto FROM carrinho WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        $produto = $stmt->fetchAll(PDO::FETCH_OBJ);

        $query = "INSERT INTO pedido (id_usuario) VALUES (:id_usuario)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        $query = "SELECT id FROM pedido WHERE id_usuario = :id_usuario ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        $id_pedido = $stmt->fetch(PDO::FETCH_OBJ);
    

        foreach($produto as $item) {
            $query = "INSERT INTO pedido_item (id_pedido, id_produto) VALUES (:id_pedido, :id_produto)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_pedido', $id_pedido->id);
            $stmt->bindValue(':id_produto', $item->id_produto);
            $stmt->execute();

            $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
        }



     
    
    }
    
}


