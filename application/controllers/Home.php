<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Api', 'api');
    }

    public function index() {
        $data['tipoEscolas'] = $this->api->tipoEscolas();
        $data['estados'] = $this->api->estados();
        
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/home');
        $this->load->view('admin/tabela-escola');
        $this->load->view('admin/modal-add-escola', $data);
        $this->load->view('admin/modal-edit-escola', $data);
    }

    

}
