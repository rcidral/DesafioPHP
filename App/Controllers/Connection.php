<?php

use PDO;
use PDOException;

class Connection {
    public static function GetDB() {
        try {
            $conn = new PDO(
                "mysql:host=localhost;dbname=shop;charset=utf8",
				"root",
				""
            );
            return $conn;
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>