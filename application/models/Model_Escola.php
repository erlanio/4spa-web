<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Escola extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function escolas($id_usuario) {
        return $this->db->query("select * from escolas as e join cidades as c on c.id = e.id_cidade JOIN estados as es on es.id = e.id_estado join config_admin as ca on e.id_escola = ca.id_escola and ca.id_usuario = $id_usuario order by e.nome_escola")->result();
    }
    public function retornaCidadesPorEstado($id_estado) {
        $this->db->where('estados_id', $id_estado);
        return $this->db->get('cidades')->result();
    }
    
    public function selectedCidades($id_estado) {
        $cidades = $this->retornaCidadesPorEstado($id_estado);
        $option = "<option value='selecione'>Selecione</option>";
        foreach ($cidades as $cidade) {
            $option .= "<option value='$cidade->id'>{$cidade->nome}</option>" . PHP_EOL;
        }
        return $option;
    }

}
