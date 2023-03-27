<?php


class Produto extends Model {
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $quantidade;
    private $img;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __construct(\PDO $db) {
        parent::__construct($db);
    }

    public function listar() {
        $query = "SELECT id, nome, descricao, preco, quantidade, img FROM produtos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    
}


abstract class Model {

	protected $db;

	public function __construct(\PDO $db) {
		$this->db = $db;
	}
}
