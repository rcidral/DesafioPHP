<?php

    namespace App\Models;
    require_once "Model.php";

    class ProdutoRecomendado extends Model {
        private $id;
        private $nome;
        private $sequencia;
        private $img;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function __construct(\PDO $db) {
            parent::__construct($db);
        }

        public function createProdutoRecomendado() {
            $query = "INSERT INTO produtos_recomendados (nome, sequencia, img) VALUES (:nome, :sequencia, :img)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':sequencia', $this->__get('sequencia'));
            $stmt->bindValue(':img', $this->__get('img'));
            $stmt->execute();
            return $this;
        }

        public function getProdutoRecomendadoById() {
            $query = "SELECT id, nome, sequencia, img FROM produtos_recomendados WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutosRecomendados() {
            $query = "SELECT id, nome, sequencia, img FROM produtos_recomendados";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutoRecomendadoSequencia1() {
            $query = "SELECT * from produtos_recomendados WHERE sequencia = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutoRecomendadoSequencia2() {
            $query = "SELECT * from produtos_recomendados WHERE sequencia = 2";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutoRecomendadoSequencia3() {
            $query = "SELECT * from produtos_recomendados WHERE sequencia = 3";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function updateProdutoRecomendado() {
            $img = "";
            if($this->__get('img') != "") {
                $img = "img = :img,";
            }
            $query = "UPDATE produtos_recomendados SET nome = :nome, $img sequencia = :sequencia WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':sequencia', $this->__get('sequencia'));
            if($this->__get('img') != "") {
                $stmt->bindValue(':img', $this->__get('img'));
            }
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $this;
        }

        public function deleteProdutoRecomendado() {
            $query = "DELETE FROM produtos_recomendados WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $this;
        }

        
    }

?>