<?php

    namespace App\Models;
    require_once "Model.php";

    class Produto extends Model {
        private $id;
        private $nome;
        private $descricao;
        private $preco;
        private $img;
        private $img1;
        private $img2;
        private $img3;
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

        public function createProduto() {
            $query = "INSERT INTO produtos (nome, descricao, preco, img, img1, img2, img3, data_criacao, data_alteracao) VALUES (:nome, :descricao, :preco, :img, :img1, :img2, :img3, NOW(), NULL)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':preco', $this->__get('preco'));
            $stmt->bindValue(':img', $this->__get('img'));
            $stmt->bindValue(':img1', $this->__get('img1'));
            $stmt->bindValue(':img2', $this->__get('img2'));
            $stmt->bindValue(':img3', $this->__get('img3'));
            $stmt->execute();
            return $this;
        }

        public function getProdutosLogado() {
            $query = "SELECT p.*, f.id as favorito FROM produtos AS p LEFT JOIN favorito AS f ON p.id = f.id_produto AND f.id_usuario = :id_usuario;";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_usuario', $_SESSION['usuario']['id']);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutos() {
            $query = "SELECT * FROM produtos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutoById() {
            $query = "SELECT p.*, f.id as favorito FROM produtos AS p LEFT JOIN favorito AS f ON p.id = f.id_produto AND f.id_usuario = :id_usuario WHERE p.id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->bindValue(':id_usuario', $_SESSION['usuario']['id']);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutoByNameImport($nome) {
            $query = "SELECT * FROM produtos WHERE nome LIKE :nome";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', '%'.$nome.'%');
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getProdutoByName() {
            $query = "SELECT * FROM produtos WHERE nome LIKE :nome OR descricao LIKE :descricao";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
            $stmt->bindValue(':descricao', '%'.$this->__get('descricao').'%');
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function listarProdutosAdmin($qtd) {
            $query = "SELECT id, nome, descricao, preco, img, img1, img2, img3, data_criacao, data_alteracao FROM produtos LIMIT $qtd";
            $stmt = $this->db->prepare($query);
            
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function updateProduto() {
            $img = "";
            if($this->__get('img') != "") {
                $img = "img = :img,";
            }
            $img1 = "";
            if($this->__get('img1') != "") {
                $img1 = "img1 = :img1,";
            }
            $img2 = "";
            if($this->__get('img2') != "") {
                $img2 = "img2 = :img2,";
            }
            $img3 = "";
            if($this->__get('img3') != "") {
                $img3 = "img3 = :img3,";
            }
            $query = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, $img $img1 $img2 $img3 data_alteracao = NOW() WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':preco', $this->__get('preco'));
            if($img != "") {
                $stmt->bindValue(':img', $this->__get('img'));
            }
            if($img1 != "") {
                $stmt->bindValue(':img1', $this->__get('img1'));
            }
            if($img2 != "") {
                $stmt->bindValue(':img2', $this->__get('img2'));
            }
            if($img3 != "") {
                $stmt->bindValue(':img3', $this->__get('img3'));
            }
            $stmt->execute();
            return $this;
        }

        public function deleteProduto() {
            $query = "DELETE FROM produtos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $this;
        }

        public function exportarProdutosCSV() {
            ob_start();
            $query = "SELECT * FROM produtos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if($produtos != null ) {
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=usuarios.csv');
                header('Pragma: no-cache');

                $output = fopen('produtos.csv', 'w');
                fputcsv($output, ['id', 'nome', 'descricao', 'preco', 'img', 'img1', 'img2', 'img3', 'data_criacao', 'data_alteracao'], ';');
                foreach($produtos as $produto) {
                    fputcsv($output, $produto, ';');
                }
                fclose($output);
                ob_end_flush();
            } else {
                $output = fopen('produtos.csv', 'w');
                fputs($output, 'Nenhum produto encontrado');
                fclose($output);
                ob_end_flush();
            }
        }

        public function importarProdutosCSV() {
            $csv = $_FILES['csv-produto'];
            $data = fopen($csv['tmp_name'], 'r');
            $row = 0;
            $expected_header = ['nome', 'descricao', 'preco', 'img', 'img1', 'img2', 'img3'];
            while($line = fgetcsv($data, 0, ";")) {
                if($row++ == 0){
                    if(count($line) !== count($expected_header)) {
                        die();
                    }
                    if($line !== $expected_header) {
                        die();
                    }
                    continue;
                }
                if($line[0] == "") {
                    continue;
                }
                $produto = Produto::getProdutoByNameImport($line[0]);
                    if($produto != null) {
                        for($i = 3; $i <= 6; $i++) {
                            if($line[$i] == "") {
                                continue;
                            }
                            $curl = curl_init();
        
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $line[$i],
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 30,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "GET",
                                CURLOPT_HTTPHEADER => array(
                                    "Content-Type: application/json"
                                ),
                            ));
        
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $picname[$i] = 'picture'.$i.date('YmdHis').'.png';
                            $filePath = './assets/product/'.$picname[$i];
                            $fp = fopen($filePath, 'x');
                            if (!$fp) {
                                echo "Failed to open file $filePath";
                            } else {
                                fwrite($fp, $response);
                                fclose($fp);
                                echo "File saved to $filePath";
                            }
                        }
                        $descricao = "";
                        if($line[1] != null) {
                            $descricao = "descricao = :descricao,";
                        }
                        $preco = "";
                        if($line[2] != null) {
                            $preco = "preco = :preco,";
                        }
                        $img = "";
                        if($line[3] != null) {
                            $img = "img = :img,";
                        }
                        $img1 = "";
                        if($line[4] != null) {
                            $img1 = "img1 = :img1,";
                        }
                        $img2 = "";
                        if($line[5] != null) {
                            $img2 = "img2 = :img2,";
                        }
                        $img3 = "";
                        if($line[6] != null) {
                            $img3 = "img3 = :img3,";
                        }
                        $query = "UPDATE produtos SET $descricao $preco $img $img1 $img2 $img3 data_alteracao = NOW() WHERE nome = :nome";
                        $stmt = $this->db->prepare($query);
                        $stmt->bindValue(':nome', $line[0]);
                        if($line[1] != null) {
                            $stmt->bindValue(':descricao', $line[1]);
                        }
                        if($line[2] != null) {
                            $stmt->bindValue(':preco', $line[2]);
                        }
                        if($line[3] != null) {
                            $stmt->bindValue(':img', $picname[3]);
                        }
                        if($line[4] != null) {
                            $stmt->bindValue(':img1', $picname[4]);
                        }
                        if($line[5] != null) {
                            $stmt->bindValue(':img2', $picname[5]);
                        }
                        if($line[6] != null) {
                            $stmt->bindValue(':img3', $picname[6]);
                        }
                        $stmt->execute();
                } else {
                        for($i = 3; $i <= 6; $i++) {
                            if($line[$i] == "") {
                                continue;
                            }
                            $curl = curl_init();
        
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $line[$i],
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 30,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "GET",
                                CURLOPT_HTTPHEADER => array(
                                    "Content-Type: application/json"
                                ),
                            ));
        
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $picname[$i] = 'picture'.$i.date('YmdHis').'.png';
                            $filePath = './assets/product/'.$picname[$i];
                            $fp = fopen($filePath, 'x');
                            if (!$fp) {
                                echo "Failed to open file $filePath";
                            } else {
                                fwrite($fp, $response);
                                fclose($fp);
                                echo "File saved to $filePath";
                            }
                        }
                        $query = "INSERT INTO produtos (nome, descricao, preco, img, img1, img2, img3, data_criacao, data_alteracao) VALUES (:nome, :descricao, :preco, :img, :img1, :img2, :img3, NOW(), NOW())";
                        $stmt = $this->db->prepare($query);
                        $stmt->bindValue(':nome', $line[0]);
                        $stmt->bindValue(':descricao', $line[1]);
                        $stmt->bindValue(':preco', $line[2]);
                        $stmt->bindValue(':img', $picname[3]);
                        $stmt->bindValue(':img1', $picname[4]);
                        $stmt->bindValue(':img2', $picname[5]);
                        $stmt->bindValue(':img3', $picname[6]);
                        $stmt->execute();
                    }
                }
        }
        public function moverProdutoCSV() {
            $datetime = date('Y-m-d_H-i-s');
            $logName = 'produtos_' . $datetime . '.csv';
            $logPath = __DIR__ . '/../logs/produto/' . $logName;
            rename('produtos.csv', $logPath);
        }
    }

?>