<?php

namespace App\Models;
use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'nome_do_banco_de_dados';
    private $username = 'usuario';
    private $password = 'senha';
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
        }

        return $this->conn;
    }
}