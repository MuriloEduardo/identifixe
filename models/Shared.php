<?php

class Shared extends model {

    protected $config;
    protected $table;

    public function __construct($table) {
        global $config;
        $this->config = &$config;
        $this->table = $table;
        parent::__construct(); 
    }

    public function montaDataTable() {
        $sql = "SHOW COLUMNS FROM $this->table";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $all = $sql->fetchAll();
            for ($i=0; $i < count($all); $i++) { 
                if ($i == 0) {
                    $columns[] = [
                        "db" => $all[$i]["Field"],
                        "dt" => $i,
                        "formatter" => function($id, $row) {
                            return '
                                <div class="btn-group btn-group-sm" role="group" aria-label="Ações">
                                    <a href="' . BASE_URL . '/' . $this->table . '/editar/' . $id . '" class="btn btn-primary">Editar</a>
                                    <a href="' . BASE_URL . '/' . $this->table . '/excluir/' . $id . '" onclick="return confirm(\'Tem Certeza?\')" class="btn btn-secondary">Excluir</a>
                                </div>
                            ';
                        }
                    ];
                } else {
                    $columns[] = [
                        "db" => $all[$i]["Field"],
                        "dt" => $i
                    ];
                }
            }
        }

        return SSP::simple($_POST, $this->config, $this->table, "id", $columns);
    }

    public function unico($campo, $valor) {
        $array = array();
        $sql = "SELECT * FROM $this->table WHERE $campo = '$valor' AND situacao = 'ativo'";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(); 
        }
        return $array;
    }
}
?>