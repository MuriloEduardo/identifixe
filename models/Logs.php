<?php

class Logs extends model {

    protected $table;
    protected $colunas;
    
    protected $permissoes;
    protected $shared;

    public function __construct($table) {

        parent::__construct(); 

        $this->table = $table;
        $this->permissoes = new Permissoes();
        $this->shared = new Shared($this->table);
        $this->colunas = $this->shared->nomeDasColunas();
    }

    public function add($tipo, $id, $request = "") {
        // $tipo - cadastro, alteração, exclusão
        // $id - id do registro que está associado ao log
        
        $content = [
            $_SESSION["idFuncionario"],
            $this->permissoes->pegaIPcliente(),
            date("Y-m-d"),
            $tipo,
            $this->table,
            $id,
            date("H:i:s")
        ];

        $values = "'" . implode("','", $content) . "'";

        $sql = "INSERT INTO logs (funcionario, ip, data, tipo, tabela, registro, hora) VALUES (" . $values . ")";
        $this->db->query($sql);

        $last_insert_id = $this->db->lastInsertId();

        if ($last_insert_id) {

            if ($tipo === "alteracao") {

                $select = "SELECT * FROM " . $this->table . " WHERE id='" . $id . "'";
                $select = $this->db->query($select);
        
                foreach ($select->fetch() as $key_select => $value_select) {
                    
                    // Se for diferente houve alteracoes
                    if (isset($request[$key_select]) && $request[$key_select] !== $value_select) {
                        
                        $alteracao = [
                            $last_insert_id,
                            $value_select,
                            $request[$key_select],
                            $key_select
                        ];

                        $values_alteracoes = "'" . implode("','", $alteracao) . "'";
        
                        $sql_alteracoes = "INSERT INTO logs_alteracoes (log, de, para, campo) VALUES (" . $values_alteracoes . ")";
            
                        $this->db->query($sql_alteracoes);
                    }
                }
            }

        }
    }

    public function logs($registro_id) {

        $select = "SELECT 
        fn.nome AS funcionario_nome,
        fn.id AS funcionario_id,
        l.ip AS funcionario_ip,
        l.id,
        l.tipo,
        l.data,
        l.hora
        FROM logs l 
        INNER JOIN funcionarios fn ON fn.id = l.funcionario
        WHERE l.registro = " . $registro_id;

        $result_sql = $this->db->query($select);
        $result_sql = $result_sql->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($result_sql as $key => $value) {
            if (!isset($result[$value["data"]])) {
                $result += [
                    $value["data"] => [$value]
                ];
            } else {
                array_push($result[$value["data"]], $value);
            }
        }

        foreach ($result as $key_data => $value_data) {
            foreach ($value_data as $key_children => $value_children) {
                $result[$key_data][$key_children]["alteracoes"] = $this->alteracoes($value_children["id"]);
            }
        }

        return $result;
    }

    protected function alteracoes($log_id) {
        $select = "SELECT * FROM logs_alteracoes WHERE log = " . $log_id;
        return $this->db->query($select)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>