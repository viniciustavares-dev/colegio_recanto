<?php

namespace App\Controllers;
use App\Models\Aluno;
use App\Models\Database;

class AlunoController {
    private $db;
    private $alunoModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->alunoModel = new Aluno($this->db);
    }

    public function obterResponsaveis($aluno_id) {
        $this->alunoModel->id = $aluno_id;
        return $this->alunoModel->obterResponsaveis();
    }
}

?>
