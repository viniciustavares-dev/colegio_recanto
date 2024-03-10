<?php

namespace App\Models;
use PDO;

class Aluno {
    private $conn;
    private $table_name = "alunos";

    public $id;
    public $cpf;
    public $nome;
    public $matricula;
    public $data_nascimento;
    public $responsavel_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criarAluno($cpf, $nome, $matricula, $dataNascimento, $responsavel_id) {
        $query = "INSERT INTO " . $this->table_name . " (cpf, nome, matricula, data_nascimento, responsavel_id) VALUES (:cpf, :nome, :matricula, :data_nascimento, :responsavel_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':data_nascimento', $dataNascimento);
        $stmt->bindParam(':responsavel_id', $responsavel_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obterAlunos() {
        $query = "SELECT id, cpf, nome, matricula, data_nascimento, responsavel_id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterAlunoPorId($id) {
        $query = "SELECT id, cpf, nome, matricula, data_nascimento, responsavel_id FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarAluno($id, $cpf, $nome, $matricula, $dataNascimento, $responsavel_id) {
        $query = "UPDATE " . $this->table_name . " SET cpf = :cpf, nome = :nome, matricula = :matricula, data_nascimento = :data_nascimento, responsavel_id = :responsavel_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':data_nascimento', $dataNascimento);
        $stmt->bindParam(':responsavel_id', $responsavel_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function excluirAluno($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obterResponsaveis() {
        $query = "SELECT r.id, r.nome, r.telefone FROM responsaveis r WHERE r.aluno_id = :aluno_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':aluno_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
