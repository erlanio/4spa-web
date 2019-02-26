<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Escolas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Escola', 'escola');
        $this->load->model('Model_Api', 'api');

        $this->load->helper('uteis');
    }

    public function index() {
        $id_logado = $this->session->userdata('usuario')->id_usuario;
        $data2['escolas'] = $this->api->escolas($id_logado);
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data = array();
        foreach ($data2['escolas'] as $r) {
            $data[] = array(
                $r->id_escola,
                $r->nome_escola,
                $r->opcoes = "<div class='col-md-12'>
               
                    <button class='btn btn-info col-md-4'
                    onclick=\"editarEscola('$r->id_escola');\"><i class='fa fa-close'></i> Editar</button>
                    
                    <button class='btn btn-danger col-md-4'
                    onclick=\"deletarEscola('$r->id_escola');\"><i class='fa fa-close'></i> Excluir</button></div>
",
            );
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => "",
            "recordsFiltered" => "",
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function getCidades() {
        $id_estado = $this->input->post('id_estado');
        echo $this->escola->selectedCidades($id_estado);
    }

    public function salvar() {
        
        
        $nomeEscola = $this->input->post('nomeEscola');
        $estado = $this->input->post('estado');
        $cidade = $this->input->post('cidade');
        $tipo = $this->input->post('tipo');
        $bairro = $this->input->post('bairro');
        $numero = $this->input->post('numero');
        $email = $this->input->post('email');
        $rua = $this->input->post('rua');
        $telefone = $this->input->post('telefone');
        $id_usuario = $this->session->userdata('usuario')->id_usuario;


        $data['nome_escola'] = $nomeEscola;
        $data['id_cidade'] = $cidade;
        $data['id_estado'] = $estado;
        $data['rua_escola'] = $rua;
        $data['bairro_escola'] = $bairro;
        $data['numero_escola'] = $numero;
        $data['email_escola'] = $email;
        $data['tipo_escola'] = $tipo;
        $data['telefone_escola'] = removerMascara($telefone);

        $query = $this->api->salvarEscola($data);
        if ($query == true) {
            $data2['id_usuario'] = $id_usuario;
            $data2['id_escola'] = $this->db->insert_id();            
            $this->api->salvarAdmin($data2);
        }
        echo $query;
    }
    
    public function deletarEscola() {
        $id = $this->input->post('id');
        $this->api->deletarEscola($id);
    }
    
    public function retornaEscolaEdit() {
        $id = $this->input->post('id');
        $data['escola'] = $this->api->retornaEscolaEdit($id);
        
        echo json_encode($data['escola']);
    }
    
     public function salvarEscolaEdicao() {
        $nomeEscola = $this->input->post('nomeEscola');
        $estado = $this->input->post('estado');
        $cidade = $this->input->post('cidade');
        $tipo = $this->input->post('tipo');
        $telefone = $this->input->post('telefone');
        $bairro = $this->input->post('bairro');
        $numero = $this->input->post('numero');
        $email = $this->input->post('email');
        $rua = $this->input->post('rua');
        $id_escola = $this->input->post('id_escola');

        $data['nome_escola'] = $nomeEscola;
        $data['id_cidade'] = $cidade;
        $data['id_estado'] = $estado;
        $data['rua_escola'] = $rua;
        $data['bairro_escola'] = $bairro;
        $data['numero_escola'] = $numero;
        $data['email_escola'] = $email;
        $data['tipo_escola'] = $tipo;
        $data['telefone_escola'] = removerMascara($telefone);

        $query = $this->api->updateEscola($id_escola, $data);
        echo json_encode($query);
    }
    

}
