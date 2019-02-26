<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('uteis');
    }

    public function index() {
        $data['categorias'] = $this->categorias->retornaCategorias();
        $data['estados'] = $this->cidEstados->retornaEstados();

        $this->load->view('header');
        $this->load->view('cadastro-pessoa', $data);
        $this->load->view('footer');
    }

    

}
