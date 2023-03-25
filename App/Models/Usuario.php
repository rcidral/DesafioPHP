<?php


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
}


abstract class Model {

	protected $db;

	public function __construct(\PDO $db) {
		$this->db = $db;
	}
}
