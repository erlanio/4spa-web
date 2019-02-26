<?php
date_default_timezone_set('America/Sao_Paulo');



foreach ($avaliacoes as $data) {
    $escola = $data->nome_escola;
    $turma = $data->cod_turma;
}
?>


<!DOCTYPE html>
<html lang="pt">
    <head>    
        <title>4SPA</title>      	       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/estilo_pdf.css'); ?>" rel="stylesheet">  
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

        <style>


            .titulo{
                border-bottom: 3px solid #121212;
                padding-top: 40px;
            }

            .titulo-nome{
                background-color: #121212;
                color: #fff;
                padding: 4px;
                width: 50px;
            }

            .atributos{
                margin-top: 10px;
            }

            .tabela{
                font-size: 16px;
                width: 3500px;
                width: 100%;
            }
            .tableClass { background-color: #fff; border-collapse: collapse;
                          font-family: DejaVuSansCondensed; font-size: 9pt; line-height: 1.2;
                          margin-top: 2pt; margin-bottom: 5pt; width: 100%;
            }

            .theadClass { font-weight: bold; vertical-align: bottom; }

            .tdClass { padding-left: 4mm; vertical-align: top; text-align:left;
                       padding-right: 4mm; padding-top: 1mm; padding-bottom: 1mm;
                       border-top: 1px solid #121212;}

            .headerRow td, .headerRow th { background-color: #121212; color: #fff; padding: 1.0mm; }
            .linha td{
                border: 1px solid #121212;
                padding: 1mm;
            }


            .linha td.assinatura{
                width: 100mm;
            }
        </style>

    </head>
    <body>
        <div class="corpo">
            <div class="cabecalho">
                <h4>Lista de Submissões:<strong> <?php echo $escola . " - " . $turma; ?></strong></h4>

            </div>   
            <hr>


            <!-- BLOCO  -->
            <div class="tabela">

                <table class="tableClass">
                    <thead class="theadClass">
                        <tr class="headerRow">
                            <th>Nome</th>
                            <td>IMC</td>
                            <td>APCR</td>
                            <td>FLEX</td>
                            <td>RML</td>                           
                        </tr>


                    </thead>
                    <tbody>
                        <?php
                        foreach ($avaliacoes as $data) {

                            $nome = $data->nome_estudante;
                            $imc_avaliacao = $data->imc_avaliacao;
                            $aptCardio = $data->aptCardio;
                            $flex_avaliacao = $data->flex_avaliacao;
                            $resAbd_avaliacao = $data->resAbd_avaliacao;
                           
                            ?>
                            <tr class="linha">
                                <td><?php echo $nome; ?></td>
                                <td><?php echo $imc_avaliacao; ?></td>
                                <td><?php echo $aptCardio; ?></td>
                                <td><?php echo $flex_avaliacao; ?></td>
                                <td><?php echo $resAbd_avaliacao; ?></td>
                          



                            </tr>


                        <?php } ?>
                         


                      
                    </tbody>
                </table>

            </div>


        </div>
    </body>
</html>


