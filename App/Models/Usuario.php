<?php

include_once '../App/Models/Model.php';

class Usuario extends Model {
    private $id;
    private $nome;
    private $email;
    private $senha;

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
        $query = "SELECT id, nome, email FROM usuarios WHERE email = :email AND senha = :senha";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        if($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            $this->__set('id', $usuario->id);
            $this->__set('nome', $usuario->nome);
            return true;
        }
        return false;
    }

    public function createUsuario() {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();
    }

    public function listar() {
        $query = "SELECT id, nome, email, senha FROM usuarios";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deletar() {
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();
    }

    public function alterar() {
        $query = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();
    }
}


