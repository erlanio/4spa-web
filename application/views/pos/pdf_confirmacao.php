
<?php
date_default_timezone_set('America/Sao_Paulo');
?>
<?php
foreach ($pessoa as $dados) {
    
}

foreach ($minicurso as $valores) {
    
}
$this->load->helper('uteis_helper');
?>

<!DOCTYPE html>
<html lang="pt">
    <head>    
        <title>CONFIRMAÇÃO DE INSCRIÇÃO</title>      	       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/estilo_pdf.css'); ?>" rel="stylesheet">           
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <!-- Bootstrap -->

        <style>



        </style>
    </head>

    <style>


    </style>
    <body>
        <div class="corpo">
            <div class="cabecalho">
                <img src="<?php echo base_url('assets/img/brasao_left_black.png'); ?> " class="img-responsive">                   
            </div>   
            <hr>
            <h3>Especialização em Gestão Financeira e Consultoria Empresarial</h3>
            
            <div class="titulo"><strong>DADOS PESSOAIS</strong><br></div>
            <div class="atributos">
                <strong>Nome: </strong><?php echo $dados->nome ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>CPF: </strong> <?php echo $dados->cpf ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Email: </strong><?php echo $dados->email ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Telefone: </strong><?php echo $dados->telefone ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>                                
            </div>
            
            <div class="titulo"><strong>DADOS DA INSCRIÇÃO</strong><br></div>
            <div class="atributos">
                <strong>Minicurso: </strong><?php echo $valores->titulo ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Data e Horário: </strong><?php echo data_br($valores->data); ?> <?php echo $valores->horario  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                         
            </div>
        </div>
    </body>
</html>

