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
        $this->load->model('Model_Minicursos', 'minicursos');

        $this->load->helper('uteis_helper');
    }

    public function index() {
        $data['minicursos'] = $this->minicursos->retornaMinicursos();

        $this->load->view('pos/header');
        $this->load->view('pos/minicursos', $data);
        $this->load->view('footer');
    }

    public function buscaCPF() {
        $cpf = $this->input->post('cpf');
        $id_minicurso = $this->input->post('id_minicurso');
        $data['pessoa'] = $this->minicursos->buscaCPF($cpf);

        foreach ($data['pessoa'] as $dados) {
            $id_pessoa = $dados->id_pessoa;
            $nome = $dados->nome;
            $email = $dados->email;
        }

        if (!empty($data['pessoa'])) {
            echo "  <div id='formulario'>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='titulo' id='titulo-t'>CPF: *</label><span id='error-email' class='aviso-erro'></span>
                        <input type='text' class='form-control' value='$cpf' id='cpf' name='cpf' >
                            <input type='hidden' id='id_minicurso' id='id_minicurso' value='$id_minicurso'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='titulo' id='titulo-t'>Nome: *</label><span id='error-email' class='aviso-erro'></span>
                        <input type='text' required class='form-control' id='nome' disabled value='$nome' name='nome' >
                    </div>
                </div>
                
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label for='titulo' id='titulo-t'>Email: *</label><span id='error-email' class='aviso-erro'></span>
                        <input type='text' required class='form-control' disabled value='$email' id='email' name='email' >
                    </div>
                    
                    <button class='btn btn-success col-md-12' onclick=\"inscrever('$id_pessoa','$id_minicurso', '$nome');\">Inscrever-me neste minicurso</button>
                </div>";
        } else {
            echo "  <div id='formulario'>
                <div class='col-md-12 alert alert-danger hidden' id='mensagem'></div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='titulo' id='titulo-t'>CPF: *</label><span id='error-email' class='aviso-erro'></span>
                        <input type='text' class='form-control' value='$cpf' id='cpf' name='cpf' >
                        <input type='hidden' id='id_minicurso' value='$id_minicurso'>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label for='titulo' id='titulo-t'>Nome: *</label><span id='error-email' class='aviso-erro'></span>
                        <input type='text' required class='form-control' id='nome'  name='nome' >
                    </div>
                </div>
                
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label for='titulo' id='titulo-t'>Email: *</label><span id='error-email' class='aviso-erro'></span>
                        <input type='text' required class='form-control'  id='email' name='email' >
                    </div>
                    
                    <button class='btn btn-success col-md-12' onclick=\"salvarPessoa();\">Inscrever-me neste minicurso</button>
                </div>";
        }
    }

    public function inscrever() {
        $id_minicurso = $this->input->post('id_minicurso');
        $id_pessoa = $this->input->post('id_pessoa');

        $data['inscricao'] = $this->minicursos->verificaInscricao($id_minicurso, $id_pessoa);

        if ($data['inscricao'] == 0) {

            $data['minicurso'] = $this->minicursos->retornaMiniscursoID($id_minicurso);
            $data5['pessoa'] = $this->minicursos->retornaPessoaID($id_pessoa);

            foreach ($data['minicurso'] as $dados) {
                $vagas = $dados->vagas;
                $minicurso = $dados->titulo;
                $data = data_br($dados->data);
                $horario = $dados->horario;
            }

            foreach ($data5['pessoa'] as $dados) {
                $nome = $dados->nome;
                $email = $dados->email;
            }





            $data3['vagas'] = $vagas - 1;
            $this->minicursos->updateMinicurso($id_minicurso, $data3);


            $data2['id_minicurso'] = $id_minicurso;
            $data2['id_pessoa'] = $id_pessoa;
            $data2['dt_inscricao'] = date('Y-m-d');
            $this->minicursos->inscrever($data2);

            $corpo = "Olá, $nome<br> Você se inscreveu no Minicusro: <strong>$minicurso</strong>, o mesmo será realizado no dia: $data, no horário de: $horario ";
            if (enviar_email($email, "Especialização em Gestão Financeira e Consultoria Empresarial", $corpo)) {
                echo '1';
            } else {
                echo 2;
            }
        }
    }

    public function salvarPessoa() {

        $data0['pessoa'] = $this->minicursos->buscaCPF($this->input->post('cpf'));
        if (empty($data0['pessoa'])) {
            $id_minicurso = $this->input->post('id_minicurso');
            $data['nome'] = $this->input->post('nome');
            $data['email'] = $this->input->post('email');
            $data['cpf'] = $this->input->post('cpf');
            $this->minicursos->salvarPessoa($data);

            $data3['id_pessoa'] = $this->minicursos->lastInsertPessoa();

            foreach ($data3['id_pessoa'] as $dados) {
                $id_pessoa = $dados->id_pessoa;
            }

            $data['minicurso'] = $this->minicursos->retornaMiniscursoID($id_minicurso);
            $data5['pessoa'] = $this->minicursos->retornaPessoaID($id_pessoa);

            foreach ($data['minicurso'] as $dados) {
                $vagas = $dados->vagas;
                $minicurso = $dados->titulo;
                $data = data_br($dados->data);
                $horario = $dados->horario;
            }

            foreach ($data5['pessoa'] as $dados) {
                $nome = $dados->nome;
                $email = $dados->email;
            }



            $data4['vagas'] = $vagas - 1;
            $this->minicursos->updateMinicurso($id_minicurso, $data4);

            $data2['id_minicurso'] = $id_minicurso;
            $data2['id_pessoa'] = $id_pessoa;
            $data2['dt_inscricao'] = date('Y-m-d');
            $this->minicursos->inscrever($data2);

            $corpo = "Olá, $nome<br> Você se inscreveu no Minicusro: <strong>$minicurso</strong>, o mesmo será realizado no dia: $data, no horário de: $horario ";
            if (enviar_email($email, "Especialização em Gestão Financeira e Consultoria Empresarial", $corpo)) {
                echo 1;
            } else {
                echo 2;
            }
        }else{
            echo 3;
        }
    }

}
