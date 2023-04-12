<?php

    namespace App\Models;
    require_once "Model.php";

    class Carrinho extends Model {
        private $id;
        private $id_usuario;
        private $id_produto;
        private $quantidade;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function __construct(\PDO $db) {
            parent::__construct($db);
        }

        public function createCarrinho() {
            $query = "SELECT id_produto FROM carrinho WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_OBJ);

            if(!empty($produtos)) {
                $query = "UPDATE carrinho SET quantidade = quantidade + :quantidade WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
                $stmt->bindValue(':id_produto', $this->__get('id_produto'));
                $stmt->bindValue(':quantidade', $this->__get('quantidade'));
                $stmt->execute();
            } else {
                $query = "INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES (:id_usuario, :id_produto, :quantidade)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
                $stmt->bindValue(':id_produto', $this->__get('id_produto'));
                $stmt->bindValue(':quantidade', $this->__get('quantidade'));
                $stmt->execute();
            }
        }

        public function comprarCarrinho() {
            $query = "SELECT * FROM carrinho INNER JOIN produtos where carrinho.id_produto = produtos.id AND carrinho.id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            $produto = $stmt->fetchAll(\PDO::FETCH_OBJ);
    
            $query = "INSERT INTO pedido (id_usuario) VALUES (:id_usuario)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
    
            $query = "SELECT id FROM pedido WHERE id_usuario = :id_usuario ORDER BY id DESC LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            $id_pedido = $stmt->fetch(\PDO::FETCH_OBJ);
        
    
            foreach($produto as $item) {
                $query = "INSERT INTO pedido_item (id_pedido, id_produto, quantidade, preco) VALUES (:id_pedido, :id_produto, :quantidade, :preco)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_pedido', $id_pedido->id);
                $stmt->bindValue(':id_produto', $item->id_produto);
                $stmt->bindValue(':quantidade', $item->quantidade);
                $stmt->bindValue(':preco', $item->preco);
                $stmt->execute();
            }
    
            $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
        }

        public function getCarrinho() {
            $query = "SELECT * FROM carrinho INNER JOIN produtos ON carrinho.id_produto = produtos.id WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        public function getQuantidade() {
            $query = "SELECT COUNT(id_produto) AS quantidade FROM carrinho WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            $quantidade = $stmt->fetch(\PDO::FETCH_OBJ);
            return $quantidade->quantidade;
        }

        public function getPrecoTotal() {
            $query = "SELECT SUM(preco * quantidade) AS preco_total FROM carrinho INNER JOIN produtos ON carrinho.id_produto = produtos.id WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            $preco_total = $stmt->fetch(\PDO::FETCH_OBJ);
            return $preco_total->preco_total;
        }
        public function updateCarrinhoMax() {
            $query = "UPDATE carrinho SET quantidade = :quantidade WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->bindValue(':quantidade', $this->__get('quantidade'));
            $stmt->execute();
        }
        public function updateCarrinhoMin() {
            $query = "UPDATE carrinho SET quantidade = :quantidade WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->bindValue(':quantidade', $this->__get('quantidade'));
            $stmt->execute();
        }

        public function removerItemCarrinho() {
            $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->execute();
        }
        public function deleteCarrinho() {
            $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
        }

    }

?>