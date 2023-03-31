<?php

include_once '../App/Models/Model.php';

class Pedido extends Model {
    private $id;
    private $id_item;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __construct(\PDO $db) {
        parent::__construct($db);
    }

    public function createPedido() {
        $query = "INSERT INTO pedidos (id_item) VALUES (:id_item)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_item', $this->__get('id_item'));
        $stmt->execute();
    }

    public function listarPedido() {
        $query = "SELECT id FROM pedido WHERE id_usuario = :id_usuario ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}