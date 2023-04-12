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
            $query = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email AND senha = :senha";
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
            $query = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email AND senha = :senha";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioById() {
            $query = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarios() {
            $query = "SELECT * FROM usuarios";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function listarUsuariosAdmin($qtd) {
            $query = "SELECT id, nome, nascimento, telefone, email, senha, foto, data_criacao, data_alteracao FROM usuarios LIMIT $qtd";
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
            $query = "DELETE FROM usuarios WHERE id = :id";
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
                fputcsv($output, array('ID', 'Nome', 'Nascimento', 'Telefone', 'Email', 'Senha', 'Foto', 'Data de Criação', 'Data de Alteração'));
                foreach($usuarios as $usuario) {
                    fputcsv($output, $usuario);
                }
                fclose($output);
                ob_end_flush();
            } else {
                $output = fopen('usuarios.csv', 'w');
                fputcsv($output, array('ID', 'Nome', 'Nascimento', 'Telefone', 'Email', 'Senha', 'Foto', 'Data de Criação', 'Data de Alteração'));
                fclose($output);
                ob_end_flush();
            }
        }

        // import 

        public function importarUsuariosCSV() {

            $csv = $_FILES['csv-user'];
            $data = fopen($csv['tmp_name'], 'r');
            $row = 0;
            while($line = fgetcsv($data)) {
                if($row > 0) {
                    $query = "INSERT INTO usuarios (nome, nascimento, telefone, email, senha, foto, data_criacao, data_alteracao) VALUES (:nome, :nascimento, :telefone, :email, :senha, :foto, NOW(), NULL)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindValue(':nome', $line[1]);
                    $stmt->bindValue(':nascimento', $line[2]);
                    $stmt->bindValue(':telefone', $line[3]);
                    $stmt->bindValue(':email', $line[4]);
                    $stmt->bindValue(':senha', $line[5]);
                    $stmt->bindValue(':foto', $line[6]);
                    $stmt->execute();
                }
                $row++;
            }
        }
    }

?>