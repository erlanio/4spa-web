<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Api', 'api');
        header('Access-Control-Allow-Origin: *');
    }

    public function categorias() {
        $data['categorias'] = $this->api->categorias();
        echo json_encode($data['categorias']);
    }

    public function produtos() {
        $id_categoria = $this->uri->segment(3);
        $data['produtos'] = $this->api->produtos($id_categoria);
        echo json_encode($data['produtos']);
    }

    public function marcas() {
        $id_produto = $this->uri->segment(3);
        $data['marca'] = $this->api->marcas($id_produto);

        echo json_encode($data['marca']);
    }
    
    public function tamanhos() {
        $id_marca = $this->uri->segment(3);
        $data['tamanho'] = $this->api->tamanhos($id_marca);        
        echo json_encode($data['tamanho']);
    }
    
    public function valores() {
        $id_tamanho = $this->uri->segment(3);
        $data['valores'] = $this->api->valores($id_tamanho);
        echo json_encode($data['valores']);
    }
    
    public function supermercado() {
        $id_supermercado = $this->uri->segment(3);
        $data['supermercado'] = $this->api->supermercado($id_supermercado);
        echo json_encode($data['supermercado']);
    }

}
