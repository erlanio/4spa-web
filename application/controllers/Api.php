<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Api', 'api');
        $this->load->helper('uteis_helper');
        header('Access-Control-Allow-Origin: *');
    }

    public function logout() {
        $this->session->sess_destroy();
    }

    public function login() {
        $email = $this->input->get('email');
        $senha = $this->input->get('senha');

        $usuario = $this->api->retornaEmailSenha($email, $senha);

        if ($usuario) {
            $dados = $this->api->retornaEmailSenha($email, $senha);
            foreach ($dados as $usuario) {
                $id_usuario = $usuario->id_usuario;
            }

            $registro = array('usuario' => $dados[0], 'usuario_logado' => true);
            $this->session->set_userdata($registro);
            $data['login'] = new \stdClass();
            $data['login']->id_usuario = $id_usuario;
            $data['login']->logado = true;
            echo json_encode($data['login']);
        } else {
            echo json_encode(0);
        }
    }

    public function escolas() {

        $id_usuario = $this->input->get('id_usuario');
        $data['escolas'] = $this->api->escolas($id_usuario);
        echo json_encode($data['escolas']);
    }

    public function escolaBuscar() {
        $id_usuario = $this->input->get('id_usuario');
        $escola = $this->input->get('query');
        $data['escola'] = $this->api->buscarEscola($escola, $id_usuario);
        echo json_encode($data['escola']);
    }

    public function tipoEscolas() {
        $data['tipoEscolas'] = $this->api->tipoEscolas();
        echo json_encode($data['tipoEscolas']);
    }

    public function estados() {
        $data['estados'] = $this->api->estados();
        echo json_encode($data['estados']);
    }

    public function cidades() {
        $id_estado = $this->input->get('id_estado');
        $data['cidades'] = $this->api->buscarCidades($id_estado);
        echo json_encode($data['cidades']);
    }

    public function salvarEscola() {
        $nomeEscola = $this->input->get('nomeEscola');
        $estado = $this->input->get('estado');
        $cidade = $this->input->get('cidade');
        $tipo = $this->input->get('tipo');
        $bairro = $this->input->get('bairro');
        $numero = $this->input->get('numero');
        $email = $this->input->get('email');
        $rua = $this->input->get('rua');
        $id_usuario = $this->input->get('id_usuario');


        $data['nome_escola'] = $nomeEscola;
        $data['id_cidade'] = $cidade;
        $data['id_estado'] = $estado;
        $data['rua_escola'] = $rua;
        $data['bairro_escola'] = $bairro;
        $data['numero_escola'] = $numero;
        $data['email_escola'] = $email;
        $data['tipo_escola'] = $tipo;


        $query = $this->api->salvarEscola($data);
        if ($query == true) {
            //   $lastId = $this->api->escolaLastInsert();
            $data2['id_usuario'] = $id_usuario;
            $data2['id_escola'] = $this->db->insert_id();
            ;
            $this->api->salvarAdmin($data2);
        }
        echo json_encode($query);
    }

    public function deletarEscola() {
        $id = $this->input->get('id');
        $query = $this->api->deletarEscola($id);
        echo json_encode($query);
    }

    public function retornaEscolaEdit() {
        $id_escola = $this->input->get('id_escola');
        $data['escola'] = $this->api->retornaEscolaEdit($id_escola);
        echo json_encode($data['escola']);
    }

    public function salvarEscolaEdicao() {
        $nomeEscola = $this->input->get('nomeEscola');
        $estado = $this->input->get('estado');
        $cidade = $this->input->get('cidade');
        $tipo = $this->input->get('tipo');
        $telefone = $this->input->get('telefone');
        $bairro = $this->input->get('bairro');
        $numero = $this->input->get('numero');
        $email = $this->input->get('email');
        $rua = $this->input->get('rua');
        $id_escola = $this->input->get('id_escola');

        $data['nome_escola'] = $nomeEscola;
        $data['id_cidade'] = $cidade;
        $data['id_estado'] = $estado;
        $data['rua_escola'] = $rua;
        $data['bairro_escola'] = $bairro;
        $data['numero_escola'] = $numero;
        $data['email_escola'] = $email;
        $data['tipo_escola'] = $tipo;
        $data['telefone_escola'] = $telefone;

        $query = $this->api->updateEscola($id_escola, $data);
        echo json_encode($query);
    }

    public function turmas() {
        $id_escola = $this->input->get('id_escola');
        $data['turmas'] = $this->api->getTurmas($id_escola);
        echo json_encode($data['turmas']);
    }

    public function adicionarTurma() {
        $id_escola = $this->input->get('id_escola');
        $cod = strtoupper($this->input->get('codTurma'));


        $data['id_escola'] = $id_escola;
        $data['cod_turma'] = $cod;
        ;
        if ($this->api->verificaTurma($cod, $id_escola) > 0) {
            echo json_encode("Já existe uma turma cadastrada come este código nesta escola!");
        } else {
            $query = $this->api->salvarTurma($data);
            echo json_encode($query);
        }
    }

    public function deletarTurma() {
        $id_turma = $this->input->get('id');
        $query = $this->api->deletarTurma($id_turma);
        echo json_encode($query);
    }

    public function editTurma() {
        $id_turma = $this->input->get('id');
        $data['turma'] = $this->api->editTurma($id_turma);
        echo json_encode($data['turma']);
    }

    public function salvarEditTurma() {
        $id_escola = $this->input->get('id_escola');
        $cod = strtoupper($this->input->get('codTurma'));
        $id_turma = $this->input->get('id_turma');

        $data['id_escola'] = $id_escola;
        $data['cod_turma'] = $cod;
        $data['id_turma'] = $id_turma;

        if ($this->api->verificaTurma($cod, $id_escola) > 0) {
            echo json_encode("Já existe uma turma cadastrada come este código nesta escola!");
        } else {
            $query = $this->api->salvarEditTurma($id_turma, $data);
            echo json_encode($query);
        }
    }

    public function searchTurma() {
        $turma = $this->input->get('query');
        $id_escola = $this->input->get('id_escola');
        $data['turma'] = $this->api->buscarTurma($turma, $id_escola);
        echo json_encode($data['turma']);
    }

    public function listaAlunos() {
        $id_turma = $this->input->get('id_turma');
        $data['alunos'] = $this->api->listaAlunos($id_turma);
        echo json_encode($data['alunos']);
    }

    public function series() {
        $data['series'] = $this->api->series();
        echo json_encode($data['series']);
    }

    public function salvarAluno() {
        $data['nome_estudante'] = strtoupper($this->input->get('nome'));
        $data['endereco_estudante'] = strtoupper($this->input->get('endereco'));
        $data['numero_estudante'] = $this->input->get('numero');
        $data['email_estudante'] = strtoupper($this->input->get('email'));
        $data['telefone_estudante'] = $this->input->get('telefone');
        $data['dt_nascimento'] = $this->input->get('nascimento');
        $data['serie_estudante'] = $this->input->get('serie');
        $data['id_turma'] = $this->input->get('id_turma');
        $data['sexo_estudante'] = $this->input->get('sexo');
        $query = $this->api->salvarAlunoTurma($data);

        echo json_encode($query);
    }

    public function deletarAluno() {
        $id = $this->input->get('id');
        $query = $this->api->deletarAluno($id);
        echo json_encode($query);
    }

    public function searchAluno() {
        $aluno = $this->input->get('query');
        $id_turma = $this->input->get('id_turma');
        $data['aluno'] = $this->api->buscarAluno($aluno, $id_turma);
        echo json_encode($data['aluno']);
    }

    public function editAluno() {
        $id_aluno = $this->input->get('id_aluno');
        $data['aluno'] = $this->api->editAluno($id_aluno);
        echo json_encode($data['aluno']);
    }

    public function editAlunoSalvar() {
        $id_aluno = $this->input->get('id_aluno');
        $data['nome_estudante'] = strtoupper($this->input->get('nome'));
        $data['endereco_estudante'] = strtoupper($this->input->get('endereco'));
        $data['numero_estudante'] = $this->input->get('numero');
        $data['email_estudante'] = strtoupper($this->input->get('email'));
        $data['telefone_estudante'] = $this->input->get('telefone');
        $data['dt_nascimento'] = $this->input->get('nascimento');
        $data['serie_estudante'] = $this->input->get('serie');
        $data['id_turma'] = $this->input->get('id_turma');
        $data['sexo_estudante'] = $this->input->get('sexo');
        $data['id_turma'] = $this->input->get('id_turma');
        $query = $this->api->salvarEditAluno($id_aluno, $data);

        echo json_encode($query);
    }

    public function buscarAlunoAval() {
        $id_aluno = $this->input->get('id_aluno');
        $data['aluno'] = $this->api->buscaAlunoAval($id_aluno);
        foreach ($data['aluno'] as $dados) {
            $dataAluno = $dados->dt_nascimento;
            $sexo = $dados->sexo_estudante;
        }
        if ($this->calculaIdade($dataAluno) < 6 || $this->calculaIdade($dataAluno) > 17) {
            echo json_encode(1);
        } else {
            $data['aluno'][0]->idade = $this->calculaIdade($dataAluno);
            $data['aluno'][0]->dataAtual = $dataAtual = date('Y-m-d');
            $data['aluno'][0]->aptIdeal = $this->apiCardiorespiratoria($this->calculaIdade($dataAluno), $sexo);
            $data['aluno'][0]->imcIdeal = $this->imcIdeial($this->calculaIdade($dataAluno), $sexo);
            $data['aluno'][0]->flexIdeal = $this->flexIdeal($this->calculaIdade($dataAluno), $sexo);
            $data['aluno'][0]->abdIdeal = $this->abdIdeal($this->calculaIdade($dataAluno), $sexo);
            echo json_encode($data['aluno']);
        }
    }

    public function calculaIdade($dataAluno) {
        $dataAtual = date('Y');
        $dataAluno = $dataAluno;
        $anoNascimento = substr($dataAluno, 0, 4);
        $idade = $dataAtual - $anoNascimento;
        return $idade;
    }

    public function apiCardiorespiratoria($idade, $sexo) {
        $data['aptIdeal'] = $this->api->apiCardiorespiratoria($idade, $sexo);
        foreach ($data['aptIdeal'] as $dados) {
            $aptIdeal = $dados->valor_cardiorespiratoria;
        }
        return $aptIdeal;
    }

    public function imcIdeial($idade, $sexo) {
        $data['imcIdeal'] = $this->api->imcIdeal($idade, $sexo);
        foreach ($data['imcIdeal'] as $dados) {
            $imcIdeal = $dados->valor_imc;
        }
        return $imcIdeal;
    }

    public function flexIdeal($idade, $sexo) {
        $data['flexIdeal'] = $this->api->flexIdeal($idade, $sexo);
        foreach ($data['flexIdeal'] as $dados) {
            $flexIdeal = $dados->valor_flex;
        }
        return $flexIdeal;
    }

    public function abdIdeal($idade, $sexo) {
        $data['abdIdeal'] = $this->api->abdIdeal($idade, $sexo);
        foreach ($data['abdIdeal'] as $dados) {
            $abdIdeal = $dados->valor_abdominal;
        }
        return $abdIdeal;
    }

    public function salvarAvaliacao() {
        $data['id_estudante'] = $this->input->get('id_aluno');
        $data['idade_avaliacao'] = $this->input->get('idade');
        $data['dt_avaliacao'] = $this->input->get('dt_avaliacao');
        $data['peso_avaliacao'] = $this->input->get('peso');
        $data['altura_avaliacao'] = $this->input->get('altura');
        $data['cintura_avaliacao'] = $this->input->get('cintura');
        $data['prat_exercicios'] = $this->input->get('prat_exercicios');
        $data['freq_semana'] = $this->input->get('freqSemanal');
        $data['hr_diarias'] = $this->input->get('hrDiarias');
        $data['isAtivo'] = $this->input->get('isAtivo');
        $data['imc_avaliacao'] = $this->input->get('imc');
        $data['imc_status'] = $this->input->get('imcSN');
        $data['aptCardio'] = $this->input->get('apc');
        $data['aptCardio_status'] = $this->input->get('apcSN');
        $data['flex_avaliacao'] = $this->input->get('flexibilidade');
        $data['flex_status'] = $this->input->get('flexSN');
        $data['resAbd_avaliacao'] = $this->input->get('abdominal');
        $data['resAbd_status'] = $this->input->get('abdSN');
        $data['dCardiometabolica'] = $this->input->get('dcardioSN');
        $data['dOsteomusculares'] = $this->input->get('dOsteo');
        $data['cinturaEstatus_status'] = $this->input->get('ceSN');

        $query = $this->api->salvarAvaliacao($data);
        echo json_encode($query);
    }

    public function buscaAvaliacao() {
        $id_aluno = $this->input->get('id_aluno');
        $data['avaliacao'] = $this->api->buscarAvaliacao($id_aluno);
        echo json_encode($data['avaliacao']);
    }

    public function deletarAvaliacao() {
        $id_avaliacao = $this->input->get('id_avaliacao');
        $query = $this->api->deletarAvaliacao($id_avaliacao);
        echo json_encode($query);
    }

    public function buscarAvaliacaoEdit() {
        $id_avaliacao = $this->input->get('id_avaliacao');
        $data['avaliacao'] = $this->api->buscarAvaliacaoEdit($id_avaliacao);

        foreach ($data['avaliacao'] as $dados) {
            $dataAluno = $dados->dt_nascimento;
            $sexo = $dados->sexo_estudante;
        }
        $data['avaliacao'][0]->idade = $this->calculaIdade($dataAluno);
        $data['avaliacao'][0]->dataAtual = $dataAtual = date('Y-m-d');
        $data['avaliacao'][0]->aptIdeal = $this->apiCardiorespiratoria($this->calculaIdade($dataAluno), $sexo);
        $data['avaliacao'][0]->imcIdeal = $this->imcIdeial($this->calculaIdade($dataAluno), $sexo);
        $data['avaliacao'][0]->flexIdeal = $this->flexIdeal($this->calculaIdade($dataAluno), $sexo);
        $data['avaliacao'][0]->abdIdeal = $this->abdIdeal($this->calculaIdade($dataAluno), $sexo);
        echo json_encode($data['avaliacao']);
    }

    public function editarAvaliacaoSalvar() {
        $data['id_estudante'] = $this->input->get('id_aluno');
        $data['idade_avaliacao'] = $this->input->get('idade');
        $data['dt_avaliacao'] = $this->input->get('dt_avaliacao');
        $data['peso_avaliacao'] = $this->input->get('peso');
        $data['altura_avaliacao'] = $this->input->get('altura');
        $data['cintura_avaliacao'] = $this->input->get('cintura');
        $data['prat_exercicios'] = $this->input->get('prat_exercicios');
        $data['freq_semana'] = $this->input->get('freqSemanal');
        $data['hr_diarias'] = $this->input->get('hrDiarias');
        $data['isAtivo'] = $this->input->get('isAtivo');
        $data['imc_avaliacao'] = $this->input->get('imc');
        $data['imc_status'] = $this->input->get('imcSN');
        $data['aptCardio'] = $this->input->get('apc');
        $data['aptCardio_status'] = $this->input->get('apcSN');
        $data['flex_avaliacao'] = $this->input->get('flexibilidade');
        $data['flex_status'] = $this->input->get('flexSN');
        $data['resAbd_avaliacao'] = $this->input->get('abdominal');
        $data['resAbd_status'] = $this->input->get('abdSN');
        $data['dCardiometabolica'] = $this->input->get('dcardioSN');
        $data['dOsteomusculares'] = $this->input->get('dOsteo');
        $data['cinturaEstatus_status'] = $this->input->get('ceSN');
        $id_avaliacao = $this->input->get('id_avaliacao');


        $query = $this->api->editarAvaliacaoSalvar($data, $id_avaliacao);
        echo json_encode($query);
    }

    public function valoresAFRS() {
        $id_turma = $this->input->get('id_turma');
        $data['avaliacoes'] = $this->api->valoresAFRS($id_turma);

        $totalZRSIMC = $this->api->totalZRSIMC($id_turma);
        $totalZRSaptCardio = $this->api->totalZRSaptCardio($id_turma);
        $totaZRSFlex = $this->api->totalZRSFlex($id_turma);
        $totaZRSResAB = $this->api->totaZRSResAB($id_turma);
        $totalZRSdCardio = $this->api->totalZRSdCardio($id_turma);
        $totalZRSdOsteo = $this->api->totalZRSdOsteo($id_turma);

        $totalAvaliacoes = $this->api->totalAvaliacoes($id_turma);

        $data['avaliacoes'][0]->totalZRSIMC = $totalZRSIMC;
        $data['avaliacoes'][0]->totalZRSaptCardio = $totalZRSaptCardio;
        $data['avaliacoes'][0]->totalZRSaptCardio = $totalZRSaptCardio;
        $data['avaliacoes'][0]->totaZRSFlex = $totaZRSFlex;
        $data['avaliacoes'][0]->totaZRSResAB = $totaZRSResAB;
        $data['avaliacoes'][0]->totalAvaliacoes = $totalAvaliacoes;
        $data['avaliacoes'][0]->totalZRSdCardio = $totalZRSdCardio;
        $data['avaliacoes'][0]->totalZRSdOsteo = $totalZRSdOsteo;


        echo json_encode($data['avaliacoes']);
    }

    public function GrafCardioMasc() {
        $id_turma = $this->input->get('id_turma');

        $totalMasculino = $this->api->totalAvaliacoesMasc($id_turma);
        $totalMasZRS = $this->api->totalAvaliacoesMasZRS($id_turma);
        $totalMasZS = $this->api->totalAvaliacoesMasZS($id_turma);

        $totalFeminino = $this->api->totalAvaliacoesFem($id_turma);
        $totalFemZRS = $this->api->totalAvaliacoesFemZRS($id_turma);
        $totalFemZS = $this->api->totalAvaliacoesFemZS($id_turma);

        $data['grafCardioMasc'] = new \stdClass();
        $data['grafCardioMasc']->ZRS = $this->porcentagem_nx($totalMasZRS, $totalMasculino);
        $data['grafCardioMasc']->ZS = $this->porcentagem_nx($totalMasZS, $totalMasculino);
        $data['grafCardioMasc']->totalMasculino = $totalMasculino;
        $data['grafCardioMasc']->totalMasculinoZRS = $totalMasZRS;
        $data['grafCardioMasc']->totalMasculinoZS = $totalMasZS;
        $data['grafCardioMasc']->totalFeminino = $totalFeminino;
        $data['grafCardioMasc']->totalFemininoZRS = $totalFemZRS;
        $data['grafCardioMasc']->totalFemininoZS = $totalFemZS;

        if ($this->porcentagem_nx($totalFemZRS, $totalFeminino) == 0) {
            $data['grafCardioMasc']->ZRSF = 0;
        } else {
            $data['grafCardioMasc']->ZRSF = $this->porcentagem_nx($totalFemZRS, $totalFeminino);
        }

        if ($this->porcentagem_nx($totalFemZS, $totalFeminino) == 0) {
            $data['grafCardioMasc']->ZSF = 0;
        } else {
            $data['grafCardioMasc']->ZSF = $this->porcentagem_nx($totalFemZS, $totalFeminino);
        }

        echo json_encode($data['grafCardioMasc']);
    }

    public function GrafOsteoMasc() {
        $id_turma = $this->input->get('id_turma');

        $totalMasculino = $this->api->totalAvaliacoesMasc($id_turma);
        $totalMasZRS = $this->api->totalAvaliacoesMasZRSOsteo($id_turma);
        $totalMasZS = $this->api->totalAvaliacoesMasZSOsteo($id_turma);

        $totalFeminino = $this->api->totalAvaliacoesFem($id_turma);
        $totalFemZRS = $this->api->totalAvaliacoesFemZRSOsteo($id_turma);
        $totalFemZS = $this->api->totalAvaliacoesFemZSOsteo($id_turma);

        $data['grafCardioMasc'] = new \stdClass();
        $data['grafCardioMasc']->ZRS = $this->porcentagem_nx($totalMasZRS, $totalMasculino);
        $data['grafCardioMasc']->ZS = $this->porcentagem_nx($totalMasZS, $totalMasculino);
        $data['grafCardioMasc']->totalMasculino = $totalMasculino;
        $data['grafCardioMasc']->totalMasculinoZRS = $totalMasZRS;
        $data['grafCardioMasc']->totalMasculinoZS = $totalMasZS;
        $data['grafCardioMasc']->totalFeminino = $totalFeminino;
        $data['grafCardioMasc']->totalFemininoZRS = $totalFemZRS;
        $data['grafCardioMasc']->totalFemininoZS = $totalFemZS;



        if ($this->porcentagem_nx($totalFemZRS, $totalFeminino) == 0) {
            $data['grafCardioMasc']->ZRSF = 0;
        } else {
            $data['grafCardioMasc']->ZRSF = $this->porcentagem_nx($totalFemZRS, $totalFeminino);
        }

        if ($this->porcentagem_nx($totalFemZS, $totalFeminino) == 0) {
            $data['grafCardioMasc']->ZSF = 0;
        } else {
            $data['grafCardioMasc']->ZSF = $this->porcentagem_nx($totalFemZS, $totalFeminino);
        }

        echo json_encode($data['grafCardioMasc']);
    }

    public function GrafCardioFem() {
        $id_turma = $this->input->get('id_turma');

        $totalFeminino = $this->api->totalAvaliacoesFem($id_turma);
        $totalFemZRS = $this->api->totalAvaliacoesFemZRS($id_turma);
        if ($totalFemZRS == 0) {
            echo json_encode(0);
        } else {
            echo json_encode($this->porcentagem_nx($totalFemZRS, $totalFeminino));
        }
    }

    public function GrafGeralCardio() {
        $id_turma = $this->input->get('id_turma');

        $totalAvaliacoes = $this->api->totalAvaliacoes($id_turma);
        $totalZRSdCardio = $this->api->totalZRSdCardio($id_turma);
        $totalZRSdOsteo = $this->api->totalZRSdOsteo($id_turma);

        $data['grafGeral'] = new \stdClass();
        $data['grafGeral']->ZRSCardio = $this->porcentagem_nx($totalZRSdCardio, $totalAvaliacoes);
        $data['grafGeral']->ZRSOsteo = $this->porcentagem_nx($totalZRSdOsteo, $totalAvaliacoes);
        $data['grafGeral']->ZSOsteo = $this->porcentagem_nx($totalAvaliacoes - $totalZRSdOsteo, $totalAvaliacoes);
        $data['grafGeral']->ZSCardio = $this->porcentagem_nx($totalAvaliacoes - $totalZRSdCardio, $totalAvaliacoes);
        $data['grafGeral']->totalZRSdCardio = $totalZRSdCardio;
        $data['grafGeral']->totalAvaliacoes = $totalAvaliacoes;
        $data['grafGeral']->totalZRSdOsteo = $totalZRSdOsteo;
        echo json_encode($data['grafGeral']);
    }

    public function porcentagem_nx($parcial, $total) {
        return ( $parcial * 100 ) / $total;
    }

    public function escolasAvaliadas() {

        $data['escolas'] = $this->api->escolasAvaliadas();
        foreach ($data['escolas'] as $dados) {
            $id_escola = array($dados->id_escola);
        }

        echo json_encode($data['escolas']);
    }

    public function salvarCadastro() {
        $data['nome'] = $this->input->get('nome');
        $data['email'] = $this->input->get('email');
        $data['senha'] = $this->input->get('senha');
        $data['nivel'] = "0";

        if ($this->api->verificaEmail($this->input->get('email')) == 0) {
            $result = $this->api->salvarCadastro($data);

            if ($result == true) {
                echo json_encode("Usuário cadastrado com Sucesso!");
            } else {
                echo json_encode("Erro, tente novamente!");
            }
        } else {
            echo json_encode("Já existe um cadastro para este Email");
        }
    }

    public function imprimirTabelaUnificada() {

        $this->load->library('mpdf2');

        $id_turma = $this->input->get('id_turma');
        $data['avaliacoes'] = $this->api->valoresAFRS($id_turma);

        $totalZRSIMC = $this->api->totalZRSIMC($id_turma);
        $totalZRSaptCardio = $this->api->totalZRSaptCardio($id_turma);
        $totaZRSFlex = $this->api->totalZRSFlex($id_turma);
        $totaZRSResAB = $this->api->totaZRSResAB($id_turma);
        $totalZRSdCardio = $this->api->totalZRSdCardio($id_turma);
        $totalZRSdOsteo = $this->api->totalZRSdOsteo($id_turma);

        $totalAvaliacoes = $this->api->totalAvaliacoes($id_turma);


        $data['totalZRSIMC'] = $this->api->totalZRSIMC($id_turma);
        $data['totalZRSaptCardio'] = $this->api->totalZRSaptCardio($id_turma);
        $data['totaZRSFlex'] = $this->api->totalZRSFlex($id_turma);
        $data['totaZRSResAB'] = $this->api->totaZRSResAB($id_turma);
        $data['totalZRSdCardio'] = $this->api->totalZRSdCardio($id_turma);
        $data['totalZRSdOsteo'] = $this->api->totalZRSdOsteo($id_turma);
        $data['totalAvaliacoes'] = $this->api->totalAvaliacoes($id_turma);

        $data['avaliacoes'][0]->totalZRSIMC = $totalZRSIMC;
        $data['avaliacoes'][0]->totalZRSaptCardio = $totalZRSaptCardio;
        $data['avaliacoes'][0]->totalZRSaptCardio = $totalZRSaptCardio;
        $data['avaliacoes'][0]->totaZRSFlex = $totaZRSFlex;
        $data['avaliacoes'][0]->totaZRSResAB = $totaZRSResAB;
        $data['avaliacoes'][0]->totalAvaliacoes = $totalAvaliacoes;
        $data['avaliacoes'][0]->totalZRSdCardio = $totalZRSdCardio;
        $data['avaliacoes'][0]->totalZRSdOsteo = $totalZRSdOsteo;


        $html = $this->load->view('relatorios/pdf_tblUnificada', $data, true);



        $mpdf = new mPDF('', 'A4-L');
        $mpdf->WriteHTML($html);

        $mpdf->Output("tblUnificada" . ".pdf", 'D');
        exit();
    }

    public function valoresAFRSImpress() {
        $this->load->library('mpdf2');
        $id_turma = $this->input->get('id_turma');
        $data['avaliacoes'] = $this->api->valoresAFRS($id_turma);

        $totalZRSIMC = $this->api->totalZRSIMC($id_turma);
        $totalZRSaptCardio = $this->api->totalZRSaptCardio($id_turma);
        $totaZRSFlex = $this->api->totalZRSFlex($id_turma);
        $totaZRSResAB = $this->api->totaZRSResAB($id_turma);
        $totalZRSdCardio = $this->api->totalZRSdCardio($id_turma);
        $totalZRSdOsteo = $this->api->totalZRSdOsteo($id_turma);

        $totalAvaliacoes = $this->api->totalAvaliacoes($id_turma);

        $data['avaliacoes'][0]->totalZRSIMC = $totalZRSIMC;
        $data['avaliacoes'][0]->totalZRSaptCardio = $totalZRSaptCardio;
        $data['avaliacoes'][0]->totalZRSaptCardio = $totalZRSaptCardio;
        $data['avaliacoes'][0]->totaZRSFlex = $totaZRSFlex;
        $data['avaliacoes'][0]->totaZRSResAB = $totaZRSResAB;
        $data['avaliacoes'][0]->totalAvaliacoes = $totalAvaliacoes;
        $data['avaliacoes'][0]->totalZRSdCardio = $totalZRSdCardio;
        $data['avaliacoes'][0]->totalZRSdOsteo = $totalZRSdOsteo;

        
        $html = $this->load->view('relatorios/pdf_valoresAFRS', $data, true);

        $mpdf = new mPDF('', 'A4-L');
        $mpdf->WriteHTML($html);

        $mpdf->Output("valoresAFRS" . ".pdf", 'D');
        exit();
    }

}
