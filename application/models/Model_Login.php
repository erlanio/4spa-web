<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Login extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function logar($email, $senha) {
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        
        return $this->db->get('usuarios')->num_rows();
    }

}
