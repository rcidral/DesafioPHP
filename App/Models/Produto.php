<?php

include_once '../App/Models/Model.php';

class Produto extends Model {
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $img;
    private $data_criacao;
    private $data_alteração;

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
        $query = "SELECT id, nome, descricao, preco, img, data_criacao, data_alteracao FROM produtos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deletar() {
        $query = "DELETE FROM carrinho WHERE id_produto = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();
        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();
    }

    public function alterar() {
        $query = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, img = :img, data_alteracao = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':preco', $this->__get('preco'));
        $stmt->bindValue(':img', $this->__get('img'));
        $stmt->execute();
    }

    public function createProduto() {
        $query = "INSERT INTO produtos (nome, descricao, preco, img, data_criacao, data_alteracao) VALUES (:nome, :descricao, :preco, :img, NOW(), null)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':preco', $this->__get('preco'));
        $stmt->bindValue(':img', $this->__get('img'));
        $stmt->execute();
    }

    public function listarProduto() {
        $query = "SELECT id, nome, descricao, preco, img FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisarProduto() {
        $query = "SELECT id, nome, descricao, preco, img FROM produtos WHERE nome LIKE :nome";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
}


