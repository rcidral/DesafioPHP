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

            $query = "SELECT * FROM pedido_item INNER JOIN produtos ON pedido_item.id_produto = produtos.id WHERE id_pedido = :id_pedido";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_pedido', $id_pedido->id);
            $stmt->execute();
            $pedido = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $query = "SELECT * FROM pedido INNER JOIN usuarios ON pedido.id_usuario = usuarios.id WHERE pedido.id = :id_pedido";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_pedido', $id_pedido->id);
            $stmt->execute();
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            $slack_url = "https://hooks.slack.com/services/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";
            $table = "* Detalhes do Pedido" .$pedido[0]['id_pedido']. "*\n\n";
            $table .= "| Produto | Quantidade | Preço |\n";
            $preco_total = 0;
            foreach($pedido as $item) {
                $table .= "| " .$item['nome']. " | " .$item['quantidade']. " | R$" .$item['preco']. " |\n";
                $preco_total += $item['preco'] * $item['quantidade'];
            }
            $table .= "| Total | | R$" .$preco_total. " |\n";
            $table .= "\n";
            $table .= "Pedido realizado por: " .$usuario['nome']. " (" .$usuario['email']. ")";
            
            $message = "Um novo pedido foi realizado!";
            $message .= $table;

            $data = array(
                "text" => $message
            );

            $payload = json_encode($data);
            $ch = curl_init($slack_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    "Content-Type: application/json",
                    "Content-Length: " . strlen($payload)
                )
            );

            $result = curl_exec($ch);
            curl_close($ch);
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