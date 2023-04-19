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

        public function getPedidosAdmin($qtd) {
            $query = "SELECT p.id AS id_pedido, SUM(pi.quantidade) AS quantidade, SUM(pi.quantidade * pi.preco) AS preco, u.email AS email FROM pedido p INNER JOIN pedido_has_pedido_item ppi ON p.id = ppi.id_pedido INNER JOIN pedido_item pi ON pi.id = ppi.id_pedido_item INNER JOIN produtos pr ON pr.id = pi.id_produto INNER JOIN usuarios u ON u.id = p.id_usuario GROUP BY p.id ORDER BY p.id DESC LIMIT $qtd";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $pedidos;
        }

        public function getPedidoProduto() {
            $query = "SELECT pi.preco AS preco, pr.nome AS nome, pi.quantidade AS quantidade FROM pedido p INNER JOIN pedido_has_pedido_item ppi ON p.id = ppi.id_pedido INNER JOIN pedido_item pi ON pi.id = ppi.id_pedido_item INNER JOIN produtos pr ON pr.id = pi.id_produto WHERE p.id = :id_pedido";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_pedido', $this->__get('id'));
            $stmt->execute();
            $a = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $a;
        }

        public function exportarPedidosCSV() {
            ob_start();
            $query = "SELECT p.id AS id_pedido, GROUP_CONCAT(pr.nome SEPARATOR ', ') AS nomes_produtos, GROUP_CONCAT(pi.quantidade SEPARATOR ', ') AS quantidades_produtos, SUM(pi.quantidade) AS quantidade_total, GROUP_CONCAT(pi.preco SEPARATOR ', ') AS preco, SUM(pi.quantidade * pi.preco) AS preco_total, u.email AS email FROM pedido p INNER JOIN pedido_has_pedido_item ppi ON p.id = ppi.id_pedido INNER JOIN pedido_item pi ON pi.id = ppi.id_pedido_item INNER JOIN produtos pr ON pr.id = pi.id_produto INNER JOIN usuarios u ON u.id = p.id_usuario GROUP BY p.id, u.email ORDER BY p.id";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if($pedidos != null) {
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=usuarios.csv');
                header('Pragma: no-cache');

                $output = fopen('pedidos.csv', 'w');
                fputcsv($output, ['ID', 'Nomes dos Produtos', 'Quantidades dos Produtos', 'Quantidade Total', 'Preço dos Produtos', 'Preco Total', 'Email'], ';');
                foreach($pedidos as $pedido) {
                    fputcsv($output, $pedido, ';');
                }
                fclose($output);
                ob_end_flush();
            } else {
                $output = fopen('pedidos.csv', 'w');
                fputcsv($output, ['Nenhum pedido encontrado'], ';');
                fclose($output);
                ob_end_flush();
            }

        }

        public function moverPedidoCSV() {
            $datetime = date('Y-m-d_H-i-s');
            $logName = 'pedidos_' . $datetime . '.csv';
            $logPath = __DIR__ . '/../logs/pedido/' . $logName;
            rename('pedidos.csv', $logPath);
        }

    }
?>