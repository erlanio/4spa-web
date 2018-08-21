<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Minicursos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function retornaMinicursos() {
        return $this->db->get('minicursos')->result();
    }

    public function buscaCPF($cpf) {
        $this->db->where('cpf', $cpf);
        return $this->db->get('pessoa')->result();
    }

    public function retornaMiniscursoID($id_minicurso) {
        $this->db->where('id_minicurso', $id_minicurso);
        return $this->db->get('minicursos')->result();
    }

    public function updateMinicurso($id_minicurso, $data) {
        $this->db->where('id_minicurso', $id_minicurso);
        $this->db->update('minicursos', $data);
    }

    public function inscrever($data) {
        $this->db->insert('inscricoes', $data);
    }

    public function verificaInscricao($id_minicurso, $id_pessoa) {
        $this->db->where('id_minicurso', $id_minicurso);
        $this->db->where('id_pessoa', $id_pessoa);
        return $this->db->get('inscricoes')->num_rows();
    }

    public function salvarPessoa($data) {
        $this->db->insert('pessoa', $data);
    }

    public function lastInsertPessoa() {
//        $this->db->order_by('id_pessoa', 'desc');
//        $this->db->limit(1);
//        return $this->db->get('pessoa')->result();

        return $this->db->query("select id_pessoa from pessoa ORDER BY id_pessoa DESC LIMIT 1")->result();
    }

    public function retornaPessoaID($id_pessoa) {
        $this->db->where('id_pessoa', $id_pessoa);
        return $this->db->get('pessoa')->result();
    }

    public function buscaPessoaID($id_pessoa) {
        $this->db->where('id_pessoa', $id_pessoa);
        return $this->db->get('pessoa')->result();
    }

    public function buscaMinicursoID($id_minicurso) {
        $this->db->where('id_minicurso', $id_minicurso);
        return $this->db->get('minicursos')->result();
    }

}
