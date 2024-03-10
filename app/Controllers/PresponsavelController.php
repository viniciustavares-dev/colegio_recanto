<?php

namespace App\Controllers;
use App\Models\Responsavel;
use App\Models\Database;

class ResponsavelController {
    private $db;
    private $responsavelModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->responsavelModel = new Responsavel($this->db);
    }

    public function obterDependentesDoResponsavel($responsavel_id) {
        return $this->responsavelModel->obterDependentes($responsavel_id);
    }
}

?>
