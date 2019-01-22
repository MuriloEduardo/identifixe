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

        $index = 0;
        foreach ($this->nomeDasColunas() as $key => $value) {
            if($value["Comment"]["ver"] != "false") {
                if(array_key_exists("label",$value["Comment"]) && $value["Comment"]["label"] == "Ações") {
                    $columns[] = [
                        "db" => $value["Field"],
                        "dt" => $index,
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
                        "db" => $value["Field"],
                        "dt" => $index
                    ];
                }
                $index++;
            }
        };

        return SSP::complex($_POST, $this->config, $this->table, "id", $columns, null, "situacao='ativo'");
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

    public function nomeDasColunas(){
        $sql = $this->db->query("SHOW FULL COLUMNS FROM " . $this->table);
        return array_map(function ($item) {
            //var_dump(utf8_encode($item["Comment"]));exit;
            $item["Comment"] = json_decode(utf8_encode($item["Comment"]), true);
            //var_dump($item["Comment"]);exit;
            return $item;
        }, $sql->fetchAll());
    }

    public function pegarListas() {
        $array = array();
        $sql = "SELECT * FROM " . $this->table . " WHERE situacao = 'ativo' ORDER BY id DESC";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(); 
        }
        return $array; 
    }
}
?>