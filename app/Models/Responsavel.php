<?php

namespace App\Models;
use PDO;

class Responsavel {
    private $conn;
    private $table_name = "responsaveis";

    public $id;
    public $cpf;
    public $nome;
    public $email;
    public $telefone;
    public $resp_data_nascimento;
    public $tipo_responsavel_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criarResponsavel($cpf, $nome, $email, $telefone, $resp_data_nascimento, $tipo_responsavel_id) {
        $query = "INSERT INTO " . $this->table_name . " (cpf, nome, email, telefone, resp_data_nascimento, tipo_responsavel_id) VALUES (:cpf, :nome, :email, :telefone, :resp_data_nascimento, :tipo_responsavel_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':resp_data_nascimento', $resp_data_nascimento);
        $stmt->bindParam(':tipo_responsavel_id', $tipo_responsavel_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obterResponsaveis() {
        $query = "SELECT id, cpf, nome, email, telefone, resp_data_nascimento, tipo_responsavel_id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterResponsavelPorId($id) {
        $query = "SELECT id, cpf, nome, email, telefone, resp_data_nascimento, tipo_responsavel_id FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarResponsavel($id, $cpf, $nome, $email, $telefone, $resp_data_nascimento, $tipo_responsavel_id) {
        $query = "UPDATE " . $this->table_name . " SET cpf = :cpf, nome = :nome, email = :email, telefone = :telefone, resp_data_nascimento = :resp_data_nascimento, tipo_responsavel_id = :tipo_responsavel_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':resp_data_nascimento', $resp_data_nascimento);
        $stmt->bindParam(':tipo_responsavel_id', $tipo_responsavel_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function excluirResponsavel($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obterDependentes($responsavel_id) {
        $query = "SELECT a.id, a.nome, a.data_nascimento FROM alunos a WHERE a.responsavel_id = :responsavel_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':responsavel_id', $responsavel_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
}
?>
