<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Pessoa', 'pessoa');
        $this->load->model('Model_Categoria', 'categorias');
        $this->load->model('Model_Cidade_Estados', 'cidEstados');
        $this->load->model('Model_IES', 'ies');
        $this->load->helper('uteis');
    }

    public function index() {
        $data['categorias'] = $this->categorias->retornaCategorias();
        $data['estados'] = $this->cidEstados->retornaEstados();

        $this->load->view('header');
        $this->load->view('cadastro-pessoa', $data);
        $this->load->view('footer');
    }

    public function getCidades() {
        $id_estado = $this->input->post('id_estado');
        echo $this->cidEstados->selectedCidades($id_estado);
    }

    public function inserirPessoa() {
        $data['dt_nascimento'] = data_bd($this->input->post('data-nascimento'));
        $data['uf'] = $this->input->post('estado');
        $data['cidade'] = $this->input->post('cidades');
        $data['nome'] = strtoupper($this->input->post('nome'));
        $data['instituicao'] = $this->input->post('instituicao');
        $data['email'] = $this->input->post('email');
        //recebe o campo telefone com máscara
        $telefone = $this->input->post('celular');

        $data['fone_fixo'] = $this->input->post('tel_fixo');
        $data['cpf'] = $this->input->post('cpf');

        //senha em MD5
        $data['senha'] = md5($this->input->post('senha'));

        $data['sexo'] = $this->input->post('sexo');
        $data['id_titulacao'] = $this->input->post('categoria_pessoa');

        //remove a máscara do telefone
        $data['celular'] = preg_replace("/\D+/", "", $telefone);

        if (($this->pessoa->retornaPessoaCPF($data['cpf']))) {
            echo "<script>"
            . "window.location.href = '"
            . base_url('Pessoa')
            . "';"
            . "alert('Usuário já cadastrado no sistema');"
            . "</script>";
        } else if (($this->pessoa->retornaPessoaEmail($data['email']))) {
            echo "<script>"
            . "window.location.href = '"
            . base_url('Pessoa')
            . "';"
            . "alert('Email já cadastrado no sistema');"
            . "</script>";
        } else {
            if ($this->pessoa->inserirPessoa($data)) {
                echo "<script>"
                . "window.location.href = '"
                . base_url('Login')
                . "';"
                . "alert('Usuário Cadastrado com sucesso! Faça Login para continuar');"
                . "</script>";
            }
        }
    }

    public function retornaIes() {
        $ies = $this->input->get('valor');
        echo $this->ies->retornaNomeIES($ies);
    }

    public function dadosPessoais() {
        $this->verificaLogado();
        $id_pessoa = $this->session->userdata('usuario')->id_pessoa;
        $id_estado = $this->session->userdata('usuario')->uf;
        $id_cidade = $this->session->userdata('usuario')->cidade;
        $data['categorias'] = $this->categorias->retornaCategorias();
        $data['ies'] = $this->ies->retornaIesId($this->session->userdata('usuario')->instituicao);
        $data['cidade'] = $this->cidEstados->retornaCidadePorId($id_cidade);
        $data['estadosAlter'] = $this->cidEstados->retornaEstadosPorId($id_estado);
        $data['estados'] = $this->cidEstados->retornaEstados();

        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('alter_dados', $data);
        $this->load->view('footer');
    }

    public function alterarPessoa() {
        $this->verificaLogado();
        $data['email'] = $this->input->post('email');
        $data['uf'] = $this->input->post('estado');
        $data['cidade'] = $this->input->post('cidades');
        $data['celular'] = preg_replace("/\D+/", "", $this->input->post('celular'));
        $data['fone_fixo'] = $this->input->post('tel_fixo');
        $data['sexo'] = $this->input->post('sexo');
        $data['id_titulacao'] = $this->input->post('categoria_pessoa');
        $id_pessoa = $this->session->userdata('usuario')->id_pessoa;
        $this->pessoa->atualizarPessoa($id_pessoa, $data);
        echo "<script>"
        . "window.location.href = '"
        . base_url('Login')
        . "';"
        . "alert('Dados Alterados com sucesso! Faça Login para continuar');"
        . "</script>";
    }

    public function FormAlterarSenha() {
        $this->verificaLogado();
        $this->load->view('admin/header');
        $this->load->view('admin/menu');
        $this->load->view('admin/alterar_senha');
        $this->load->view('footer');
    }

    public function alterarSenha() {
        $this->verificaLogado();
        $senhaAtual = md5($this->input->post('senha-atual'));
        $novaSenha = md5($this->input->post('senha'));
        $senhaUsuario = $this->session->userdata('usuario')->senha;
        $id_usuario = $this->session->userdata('usuario')->id_pessoa;
        $data['senha'] = $novaSenha;
        if ($senhaAtual == $senhaUsuario) {
            $this->pessoa->atualizarPessoa($id_usuario, $data);
            echo "<script>"
            . "window.location.href = '"
            . base_url('Login')
            . "';"
            . "alert('Sucesso! Efetue login para continuar');"
            . "</script>";
        } else {
            echo "<script>"
            . "window.location.href = '"
            . base_url('Pessoa/FormAlterarSenha')
            . "';"
            . "alert('Dados incoretos!');"
            . "</script>";
        }
    }

    public function verificaLogado() {
        if (!$this->session->userdata('usuario_logado')) {
            echo "<script>"
            . "window.location.href = '"
            . base_url('Login')
            . "';"
            . "alert('Você não efetuou login!');"
            . "</script>";
        }
    }

}
