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
    }

?>