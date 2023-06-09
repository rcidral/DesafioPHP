<?php

    namespace App\Models;
    require_once "Model.php";

    class Usuario extends Model {
        
        private $id;
        private $nome;
        private $nascimento;
        private $telefone;
        private $email;
        private $senha;
        private $foto;
        private $data_criacao;
        private $data_alteracao;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function __construct(\PDO $db) {
            parent::__construct($db);
        }

        public function validarLogin() {
            $query = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email AND senha = :senha AND delected = false";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();
            
            $email = $this->__get('email');
            $senha = $this->__get('senha');
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($usuario['email'] != $email || $usuario['senha'] != $senha) {
                return null;
            }
            return $this;
        }

        public function createUsuario() {
            $query = "INSERT INTO usuarios (nome, nascimento, telefone, email, senha, foto, data_criacao, data_alteracao) VALUES (:nome, :nascimento, :telefone, :email, :senha, :foto, NOW(), NULL)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':nascimento', $this->__get('nascimento'));
            $stmt->bindValue(':telefone', $this->__get('telefone'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->bindValue(':foto', $this->__get('foto'));
            $stmt->execute();
            return $this;
        }

        public function getUsuario() {
            $query = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email AND senha = :senha AND delected = false";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioById() {
            $query = "SELECT * FROM usuarios WHERE id = :id AND delected = false";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioByNameImport($nome) {
            $query = "SELECT * FROM usuarios WHERE nome = :nome AND delected = false";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $nome);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarios() {
            $query = "SELECT * FROM usuarios WHERE delected = false";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function listarUsuariosAdmin($qtd) {
            $query = "SELECT id, nome, nascimento, telefone, email, senha, foto, data_criacao, data_alteracao FROM usuarios WHERE delected = false LIMIT $qtd";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function updateUsuario() {
            $query = "UPDATE usuarios SET nome = :nome, nascimento = :nascimento, telefone = :telefone, email = :email, senha = :senha, foto = :foto, data_alteracao = NOW() WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $id = $this->__get('id');
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':nascimento', $this->__get('nascimento'));
            $stmt->bindValue(':telefone', $this->__get('telefone'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->bindValue(':foto', $this->__get('foto'));
            $stmt->execute();
            return $this;
        }

        public function deleteUsuario() {
            $query = "UPDATE usuarios SET delected = true WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $this;
        }

        // export

        public function exportarUsuariosCSV() {
            ob_start();
            $query = "SELECT * FROM usuarios";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if($usuarios != null) {
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=usuarios.csv');
                header('Pragma: no-cache');

                $output = fopen('usuarios.csv', 'w');
                fputcsv($output, ['ID', 'Nome', 'Nascimento', 'Telefone', 'Email', 'Senha', 'Foto', 'Data de Criacao', 'Data de Alteracao', 'Cancelado'], ';');
                foreach($usuarios as $usuario) {
                    fputcsv($output, $usuario, ';');
                }
                fclose($output);
                ob_end_flush();
            } else {
                $output = fopen('usuarios.csv', 'w');
                fputcsv($output, ['Nenhum usuario encontrado'], ';');
                fclose($output);
                ob_end_flush();
            }
        }

        public function moverUsuarioCSV() {
            $datetime = date('Y-m-d_H-i-s');
            $logName = 'usuarios_' . $datetime . '.csv';
            $logPath = __DIR__ . '/../logs/user/' . $logName;
            rename('usuarios.csv', $logPath);
        }

        // import 

        public function importarUsuariosCSV() {

            $csv = $_FILES['csv-user'];
            $data = fopen($csv['tmp_name'], 'r');
            $row = 0;
            $expected_header = ['Nome', 'Nascimento', 'Telefone', 'Email', 'Senha', 'Foto'];
            while ($line = fgetcsv($data, 0, ";")){
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
                $usuario = $this->getUsuarioByNameImport($line[0]);
                if($usuario != null) {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $line[5],
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
                    $picname = 'picture'.date('YmdHis').'.png';
                    $filePath = './assets/user/'.$picname;
                    $fp = fopen($filePath, 'x');
                    if (!$fp) {
                        echo "Failed to open file $filePath";
                    } else {
                        fwrite($fp, $response);
                        fclose($fp);
                        echo "File saved to $filePath";
                    }
                
                    $nascimento = "";
                    if($line[1] != null) {
                        $nascimento = "nascimento = :nascimento,";
                        $explode = explode('/', $line[1]);
                        $line[1] = $explode[2] . '-' . $explode[1] . '-' . $explode[0];
                    }
                    $telefone = "";
                    if($line[2] != null) {
                        $telefone = "telefone = :telefone,";
                    }
                    $email = "";
                    if($line[3] != null) {
                        $email = "email = :email,";
                    }
                    $senha = "";
                    if($line[4] != null) {
                        $senha = "senha = :senha,";
                    }
                    $foto = "";
                    if($line[5] != null) {
                        $foto = "foto = :foto,";
                    }
                
                    $query = "UPDATE usuarios SET $nascimento $telefone $email $senha $foto data_alteracao = NOW() WHERE nome = :nome";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindValue(':nome', $line[0]);
                    
                    if($line[1] != null) {
                        $stmt->bindValue(':nascimento', $line[1]);
                    }
                    if($line[2] != null) {
                        $stmt->bindValue(':telefone', $line[2]);
                    }
                    if($line[3] != null) {
                        $stmt->bindValue(':email', $line[3]);
                    }
                    if($line[4] != null) {
                        $stmt->bindValue(':senha', $line[4]);
                    }
                    if($line[5] != null) {
                        $stmt->bindValue(':foto', $filePath);
                    }
                    $stmt->execute();
            } else {
                if($line[5] != "") {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $line[5],
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
                $picname = 'picture'.date('YmdHis').'.png';
                $filePath = './assets/user/'.$picname;
                $fp = fopen($filePath, 'x');
                if (!$fp) {
                    echo "Failed to open file $filePath";
                } else {
                    fwrite($fp, $response);
                    fclose($fp);
                    echo "File saved to $filePath";
                }
            }
                $explode = explode('/', $line[1]);
                $line[1] = $explode[2] . '-' . $explode[1] . '-' . $explode[0];

                $query = "INSERT INTO usuarios (nome, nascimento, telefone, email, senha, foto, data_criacao, data_alteracao) VALUES (:nome, :nascimento, :telefone, :email, :senha, :foto, NOW(), NOW())";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':nome', $line[0]);
                $stmt->bindValue(':nascimento', $line[1]);
                $stmt->bindValue(':telefone', $line[2]);
                $stmt->bindValue(':email', $line[3]);
                $stmt->bindValue(':senha', $line[4]);
                $stmt->bindValue(':foto', $filePath);
                $stmt->execute();
            }
        }
        }
    }

?>