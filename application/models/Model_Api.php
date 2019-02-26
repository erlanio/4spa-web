<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Api extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function retornaEmailSenha($email, $senha) {
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
//      $this->db->where('nivel', 1);
        return $this->db->get('usuarios')->result();
    }

    public function escolas($id_usuario) {
        return $this->db->query("select * from escolas as e join cidades as c on c.id = e.id_cidade JOIN estados as es on es.id = e.id_estado join config_admin as ca on e.id_escola = ca.id_escola and ca.id_usuario = $id_usuario order by e.nome_escola")->result();
    }

    public function buscarEscola($escola, $id_usuario) {
        return $this->db->query("select * from escolas as e join cidades as c on c.id = e.id_cidade JOIN estados as es on es.id = e.id_estado join config_admin as ca on e.id_escola = ca.id_escola and ca.id_usuario = $id_usuario where e.nome_escola like '%$escola%' order by e.nome_escola")->result();
    }

    public function tipoEscolas() {
        return $this->db->query("select * from tipo_escola order by descricao")->result();
    }

    public function estados() {
        return $this->db->query("select * from estados order by sigla")->result();
    }

    public function buscarCidades($id_estado) {
        return $this->db->query("select * from cidades where estados_id = $id_estado order by nome")->result();
    }

    public function salvarEscola($data) {
        return $this->db->insert('escolas', $data);
    }

    public function escolaLastInsert() {
        return $this->db->query("select id_escola from escolas order by id_escola desc limit 1")->result();
    }
    
    public function salvarAdmin($data) {
        $this->db->insert('config_admin', $data);
    }
    
    public function deletarEscola($id) {
        $this->db->where('id_escola', $id);
        return $this->db->delete('escolas');
    }

    public function retornaEscolaEdit($id) {
        return $this->db->query("select * from escolas as e join cidades as c on c.id = e.id_cidade JOIN estados as es on es.id = e.id_estado where e.id_escola = $id")->result();
    }

    public function updateEscola($id, $data) {
        $this->db->where('id_escola', $id);
        return $this->db->update('escolas', $data);
    }

    public function getTurmas($id_escola) {
        return $this->db->query("select * from turmas as t join escolas as e on e.id_escola = t.id_escola where t.id_escola = $id_escola")->result();
    }

    public function verificaTurma($cod, $id) {
        $this->db->where('cod_turma', $cod);
        $this->db->where('id_escola', $id);
        return $this->db->get('turmas')->num_rows();
    }

    public function salvarTurma($data) {
        return $this->db->insert('turmas', $data);
    }

    public function deletarTurma($id) {

        $this->db->where('id_turma', $id);
        return $this->db->delete('turmas');
    }

    public function editTurma($id) {
        $this->db->where('id_turma', $id);
        return $this->db->get('turmas')->result();
    }

    public function salvarEditTurma($id, $data) {
        $this->db->where('id_turma', $id);
        return $this->db->update('turmas', $data);
    }

    public function buscarTurma($query, $id_escola) {
        return $this->db->query("select * from turmas as t join escolas as e on e.id_escola = t.id_escola where t.cod_turma like '$query%' and t.id_escola = $id_escola")->result();
    }

    public function listaAlunos($id_turma) {
        return $this->db->query("select * from estudantes as e join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola WHERE t.id_turma = $id_turma ORDER BY e.nome_estudante")->result();
    }

    public function series() {
        $this->db->order_by('descricao_serie');
        return $this->db->get('series')->result();
    }

    public function salvarAlunoTurma($data) {
        return $this->db->insert('estudantes', $data);
    }

    public function deletarAluno($id) {
        $this->db->where('id_estudante', $id);
        return $this->db->delete('estudantes');
    }

    public function buscarAluno($query, $id_turma) {
        return $this->db->query("select * from estudantes as e join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola WHERE e.nome_estudante LIKE '$query%' and t.id_turma = $id_turma ORDER BY e.nome_estudante")->result();
    }

    public function editAluno($id) {
        $this->db->where('id_estudante', $id);
        return $this->db->get('estudantes')->result();
    }

    public function salvarEditAluno($id_aluno, $data) {
        $this->db->where('id_estudante', $id_aluno);
        return $this->db->update('estudantes', $data);
    }

    public function buscaAlunoAval($id) {
        return $this->db->query("select * from estudantes as e join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where e.id_estudante = $id")->result();
    }

    public function apiCardiorespiratoria($idade, $sexo) {
        return $this->db->query("select * from apt_cardiorespiratoria where idade_cardiorespiratoria = $idade and sexo_cardiorespiratoria = '$sexo'")->result();
    }

    public function imcIdeal($idade, $sexo) {
        return $this->db->query("select * from imc where idade_imc = $idade and sexo_imc = '$sexo'")->result();
    }

    public function flexIdeal($idade, $sexo) {
        return $this->db->query("select * from flexibilidade where idade_flex = $idade and sexo_flex = '$sexo'")->result();
    }

    public function abdIdeal($idade, $sexo) {
        return $this->db->query("select * from abdominal where idade_abdominal = $idade and sexo_abdominal = '$sexo'")->result();
    }

    public function salvarAvaliacao($data) {
        return $this->db->insert('avaliacoes', $data);
    }

    public function buscarAvaliacao($id_aluno) {
        return $this->db->query("select a.id_avaliacao, a.isAtivo, a.dt_avaliacao, a.imc_avaliacao, a.aptCardio, a.flex_avaliacao, a.resAbd_avaliacao, e.nome_estudante, es.nome_escola, t.cod_turma from avaliacoes as a JOIN estudantes as e on e.id_estudante = a.id_estudante JOIN turmas as t on t.id_turma = e.id_turma JOIN escolas as es on es.id_escola = t.id_escola where e.id_estudante = $id_aluno ORDER BY a.id_avaliacao DESC")->result();
    }

    public function deletarAvaliacao($id_avaliacao) {

        $this->db->where('id_avaliacao', $id_avaliacao);
        return $this->db->delete('avaliacoes');
    }

    public function buscarAvaliacaoEdit($id_avaliacao) {
        return $this->db->query("SELECT * FROM
                avaliacoes as a join 
                estudantes as e on e.id_estudante = a.id_estudante
                join turmas as t on t.id_turma = e.id_turma 
                join escolas as es on es.id_escola = t.id_escola
                WHERE a.id_avaliacao = $id_avaliacao")->result();
    }

    public function editarAvaliacaoSalvar($data, $id_avaliacao) {
        $this->db->where('id_avaliacao', $id_avaliacao);
        return $this->db->update('avaliacoes', $data);
    }

    public function valoresAFRS($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma ORDER BY av.dt_avaliacao DESC")->result();
    }

    public function totalAvaliacoes($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma")->num_rows();
    }

    public function totalAvaliacoesMasc($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'M'")->num_rows();
    }

    public function totalAvaliacoesFem($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'F'")->num_rows();
    }

    public function totalAvaliacoesMasZRS($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'M' and`dCardiometabolica` = 'SIM'")->num_rows();
    }

    public function totalAvaliacoesMasZRSOsteo($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'M' and`dOsteomusculares` = 'SIM'")->num_rows();
    }

    public function totalAvaliacoesMasZS($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'M' and`dCardiometabolica` = 'NÃO'")->num_rows();
    }

    public function totalAvaliacoesMasZSOsteo($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'M' and`dOsteomusculares` = 'NÃO'")->num_rows();
    }

    public function totalAvaliacoesFemZS($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'F' and`dCardiometabolica` = 'NÃO'")->num_rows();
    }

    public function totalAvaliacoesFemZSOsteo($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'F' and`dOsteomusculares` = 'NÃO'")->num_rows();
    }

    public function totalAvaliacoesFemZRS($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'F' and`dCardiometabolica` = 'SIM'")->num_rows();
    }

    public function totalAvaliacoesFemZRSOsteo($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and e.sexo_estudante = 'F' and`dOsteomusculares` = 'SIM'")->num_rows();
    }

    public function totalZRS($id_turma) {
        return $this->db->query("select * from avaliacoes as av join estudantes as e on e.id_estudante = av.id_estudante join turmas as t on t.id_turma = e.id_turma join escolas as es on es.id_escola = t.id_escola where t.id_turma = $id_turma and`dCardiometabolica` = 'SIM'")->num_rows();
    }

    public function totalZRSIMC($id_turma) {
        return $this->db->query("select 
	* from avaliacoes as av
    join estudantes as es on av.id_estudante = es.id_estudante
    join turmas as t on t.id_turma = es.id_turma where av.imc_status = 'ZRS' and t.id_turma = $id_turma")->num_rows();
    }

    public function totalZRSaptCardio($id_turma) {
        return $this->db->query("select 
	* from avaliacoes as av
    join estudantes as es on av.id_estudante = es.id_estudante
    join turmas as t on t.id_turma = es.id_turma where av.aptCardio_status = 'ZRS' and t.id_turma = $id_turma")->num_rows();
    }

    public function totalZRSFlex($id_turma) {
        return $this->db->query("select 
	* from avaliacoes as av
    join estudantes as es on av.id_estudante = es.id_estudante
    join turmas as t on t.id_turma = es.id_turma where av.flex_status = 'ZRS' and t.id_turma = $id_turma")->num_rows();
    }

    public function totaZRSResAB($id_turma) {
        return $this->db->query("select 
	* from avaliacoes as av
    join estudantes as es on av.id_estudante = es.id_estudante
    join turmas as t on t.id_turma = es.id_turma where av.resAbd_status = 'ZRS' and t.id_turma = $id_turma")->num_rows();
    }
    
    public function totalZRSdCardio($id_turma) {
        return $this->db->query("select 
	* from avaliacoes as av
    join estudantes as es on av.id_estudante = es.id_estudante
    join turmas as t on t.id_turma = es.id_turma where av.dCardiometabolica = 'SIM' and t.id_turma = $id_turma")->num_rows();
    }
    
    public function totalZRSdOsteo($id_turma) {
        return $this->db->query("select 
	* from avaliacoes as av
    join estudantes as es on av.id_estudante = es.id_estudante
    join turmas as t on t.id_turma = es.id_turma where av.dOsteomusculares = 'SIM' and t.id_turma = $id_turma")->num_rows();
    }
    
    public function escolasAvaliadas() {
        return $this->db->query("select distinct esc.nome_escola, esc.id_escola from avaliacoes as av join estudantes as es on es.id_estudante = av.id_estudante join turmas as t on t.id_turma = es.id_turma join escolas as esc on esc.id_escola = t.id_escola")->result();
    }
    
    public function escolasAvaliadasCardio($id_escola) {
        return $this->db->query("select distinct av.id_avaliacao from avaliacoes as av join estudantes as es on es.id_estudante = av.id_estudante join turmas as t on t.id_turma = es.id_turma join escolas as esc on esc.id_escola = t.id_escola WHERE av.dCardiometabolica ='SIM' and esc.id_escola = $id_escola ")->result();
    }
    
    public function salvarCadastro($data) {
        return $this->db->insert('usuarios', $data);
    }
    
    public function verificaEmail($email) {
        $this->db->where('email', $email);
        return $this->db->get('usuarios')->num_rows();
    }

}
