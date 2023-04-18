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
                $query = "INSERT INTO pedido_item (id_produto, quantidade, preco) VALUES (:id_produto, :quantidade, :preco)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_produto', $item->id_produto);
                $stmt->bindValue(':quantidade', $item->quantidade);
                $stmt->bindValue(':preco', $item->preco);
                $stmt->execute();

                $query = "SELECT id FROM pedido_item WHERE id_produto = :id_produto AND quantidade = :quantidade AND preco = :preco ORDER BY id DESC LIMIT 1";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_produto', $item->id_produto);
                $stmt->bindValue(':quantidade', $item->quantidade);
                $stmt->bindValue(':preco', $item->preco);
                $stmt->execute();
                $id_pedido_item = $stmt->fetch(\PDO::FETCH_OBJ);

                $query = "INSERT INTO pedido_has_pedido_item (id_pedido, id_pedido_item) VALUES (:id_pedido, :id_pedido_item)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':id_pedido', $id_pedido->id);
                $stmt->bindValue(':id_pedido_item', $id_pedido_item->id);
                $stmt->execute();

            }
    
            $query = "DELETE FROM carrinho WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();

            $query = "SELECT p.id AS id_pedido, pr.nome AS nome_produto, pi.quantidade AS quantidade_produto, pi.preco AS preco_produto, (pi.quantidade * pi.preco) AS preco_total_produto, SUM(pi.quantidade * pi.preco) AS preco_total_pedido, u.nome AS nome_usuario, u.email AS email_usuario  FROM pedido p  INNER JOIN pedido_has_pedido_item ppi ON p.id = ppi.id_pedido  INNER JOIN pedido_item pi ON pi.id = ppi.id_pedido_item  INNER JOIN produtos pr ON pr.id = pi.id_produto  INNER JOIN usuarios u ON u.id = p.id_usuario  WHERE p.id = :id_pedido GROUP BY p.id, pr.id  ORDER BY p.id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_pedido', $id_pedido->id);
            $stmt->execute();
            $pedido = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $query = "SELECT * FROM info";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $info = $stmt->fetch(\PDO::FETCH_OBJ);

            $slack_url = $info->slack_url;
            $table = "* Detalhes do Pedido " .$pedido[0]['id_pedido']. "*\n\n";
            $table .= "*Nome do Cliente:* " .$pedido[0]['nome_usuario']. "\n";
            $table .= "*Email do Cliente:* " .$pedido[0]['email_usuario']. "\n\n";
            $table .= "*Produtos:* \n";
            $preco_total_pedido = 0;
            foreach($pedido as $item) {
                $table .= "Nome: " .$item['nome_produto']. " | Quantidade: " .$item['quantidade_produto']. " | Preço: R$" .$item['preco_produto']. " | Preço Total: R$" .$item['preco_total_produto']. "\n";
                $preco_total_pedido += $item['preco_total_produto'];
            }
            $table .= "\n*Preço Total do Pedido:* R$" .$preco_total_pedido. "\n";
            
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

            $url = $info->wpp_url;

            $data = array(
                "number" => "5547991164337",
                "text" => $message
            );

            $headers = array(
                'Content-Type: application/json', 
                'SecretKey: '.$info->secret_key, 
                'PublicToken: '.$info->public_token,
                'DeviceToken: '.$info->device_token,
                'Authorization: '.$info->auth
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
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