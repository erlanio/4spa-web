<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Api extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function categorias() {
        return $this->db->get('categorias')->result();
    }
    
    public function produtos($id_categoria) {
        return $this->db->query("select p.*, c.* from categorias as c INNER join produtos as p on p.id_categoria = c.id_categoria where p.id_categoria = $id_categoria")->result();
    }
    
     public function num_marcas($id_marca) {
        return $this->db->query("select m.*, p.* from marcas as m INNER join produtos as p on m.id_produto = p.id_produto WHERE p.id_produto = $id_marca" )->num_rows();
    }
    
    public function marcas($id_marca) {
        return $this->db->query("select m.*, p.* from marcas as m INNER join produtos as p on m.id_produto = p.id_produto WHERE p.id_produto = $id_marca" )->result();
    }
    
    public function tamanhos($id_marca) {
        return $this->db->query("

select t.*, ct.*, m.* from marcas as m INNER JOIN config_tamanhos as ct on ct.id_marca = m.id_marca INNER JOIN tamanhos as t on t.id_tamanho = ct.id_tamanho where m.id_marca = $id_marca ORDER BY t.desc_tamanho")->result();        
    }

    public function valores($id_tamanho) {
        return $this->db->query("select m.*, v.*, ct.*, s.*, t.*, p.* from marcas as m INNER JOIN config_tamanhos as ct on ct.id_marca = m.id_marca INNER join tamanhos as t on t.id_tamanho = ct.id_tamanho INNER JOIN valores as v on v.id_tamanho = ct.id_tamanho INNER JOIN supermecados as s on s.id_supermercado = v.id_supermercado INNER JOIN produtos as p on p.id_produto = m.id_produto WHERE t.id_tamanho = $id_tamanho ORDER BY v.valor ASC")->result();
    }
    
    public function supermercado($id_supermercado) {
        return $this->db->query("SELECT * from supermecados WHERE id_supermercado = $id_supermercado")->result();
    }
}
