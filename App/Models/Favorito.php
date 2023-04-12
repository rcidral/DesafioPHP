<?php

    namespace App\Models;
    require_once "Model.php";

    class Favorito extends Model {
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

        public function createFavorito() {
            $query = "SELECT id_produto FROM favorito WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_OBJ);

            if(!empty($produtos)) {
                return;
            } else {
                $query = "INSERT INTO favorito (id_usuario, id_produto) VALUES (:id_usuario, :id_produto)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
                $stmt->bindValue(':id_produto', $this->__get('id_produto'));
                $stmt->execute();
            }
        }

        public function getFavoritos() {
            $query = "SELECT * FROM favorito INNER JOIN produtos ON favorito.id_produto = produtos.id WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $produtos;
        }

        public function getFavoritosAdmin() {
            $query = "SELECT * FROM favorito INNER JOIN produtos ON favorito.id_produto = produtos.id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $produtos;
        }

        public function getMostFavoritos() {
            $query = 'SELECT p.nome, id_produto, COUNT(*) AS total
            FROM favorito as f
            inner join produtos as p on (f.id_produto = p.id)
            GROUP BY id_produto
            ORDER BY total DESC
            LIMIT 3;';
            $smtm = $this->db->prepare($query);
            $smtm->execute();
            
            return $smtm->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        public function deleteFavorito() {
            $query = "DELETE FROM favorito WHERE id_usuario = :id_usuario AND id_produto = :id_produto";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->execute();
        }

        public function deleteFavoritos() {
            $query = "DELETE FROM favorito WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
        }

        public function exportarFavoritoCSV() {
            ob_start();
            $query = "SELECT p.* FROM favorito f INNER JOIN produtos p ON f.id_produto = p.id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if(!empty($produtos)) {
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=usuarios.csv');
                header('Pragma: no-cache');

                $output = fopen("favoritos.csv", 'w');
                fputcsv($output, array('id', 'nome', 'descricao', 'preco', 'img', 'img1', 'img2', 'img3', 'data_criacao', 'data_alteracao'));
                foreach($produtos as $produto) {
                    fputcsv($output, $produto);
                }
                fclose($output);
                ob_end_flush();
            } else {
                $output = fopen("favoritos.csv", 'w');
                fputcsv($output, array('id', 'nome', 'descricao', 'preco', 'img', 'img1', 'img2', 'img3', 'data_criacao', 'data_alteracao'));
                fclose($output);
                ob_end_flush();
            }
        }
    }

?>