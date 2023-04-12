<?php

    namespace App\Models;
    require_once "Model.php";

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

        public function getPedido() {
            $query = "SELECT id FROM pedido WHERE id_usuario = :id_usuario ORDER BY id DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            $pedido = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $pedido;
        }

        public function getPedidosAdmin() {
            $query = "SELECT * FROM pedido INNER JOIN usuarios ON pedido.id_usuario = usuarios.id INNER JOIN pedido_item ON pedido.id = pedido_item.id_pedido";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $pedidos;
        }

    }
?>