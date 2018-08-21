<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">							
                        Especialização em Gestão Financeira e Consultoria Empresarial
                    </h1>
                </div>

                <blockquote>
                    <p>Minicursos disponíveis</p>					
                </blockquote>                       
                <table class="table table-responsive table-action">
                    <thead>
                        <tr>
                            <th>Minicurso</th>
                            <th>Ministrante</th>
                            <th>Vagas Disponíveis</th>
                            <th>Local</th>
                            <th>Horário</th>
                            <th>Data</th>
                            <th>Inverva-se</th>

                        </tr>
                    </thead>

                    <?php
                    foreach ($minicursos as $dados) {
                        $id_minicurso = $dados->id_minicurso;
                        $titulo = $dados->titulo;
                        $ministrantes = $dados->ministrante;
                        $vagas = $dados->vagas;
                        $local = $dados->local;
                        $horario = $dados->horario;
                        $data = data_br($dados->data);
                        ?>

                        <tbody>
                        <td><strong><?php echo $titulo; ?></strong></td>
                        <td><?php echo $ministrantes; ?></td>
                        <td><?php echo $vagas; ?></td>
                        <td><?php echo $local; ?></td>
                        <td><?php echo $horario; ?></td>
                        <td><?php echo $data; ?></td>

                        <?php if ($vagas > 0) { ?>

                            <td><button class="btn btn-success" data-toggle="modal" data-target="#modal-cadastro" onclick="atribuirIDMinicurso('<?php echo $id_minicurso; ?>');">Inscreva-se</button></td>

                        <?php } else { ?>
                            <td><button class="btn btn-danger" data-toggle="modal" data-target="#modal-cadastro" disabled="" >Não há vagas</button></td>
                        <?php } ?>
                        </tbody>

                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-wide fade" id="modal-cadastro" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">


                <h4 class="modal-title">Cadastro</h4>
            </div>
            <div class="modal-body" id="modalCadastro">         
                <div class="col-md-12" id="inscrito" >
                    <div class="alert alert-danger">
                        Ops! Você já está inscrito neste minicurso
                    </div>
                </div>
                <div id="formulario">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo" id="titulo-t">CPF: *</label><span id="error-email" class="aviso-erro"></span>
                            <input type="text" required="" class="form-control" id="cpf" name="cpf" >
                            <input type="hidden" id="id_minicurso" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo" id="titulo-t">Nome: *</label><span id="error-email" class="aviso-erro"></span>
                            <input type="text" required="" class="form-control" id="nome" name="nome" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo" id="titulo-t">Email: *</label><span id="error-email" class="aviso-erro"></span>
                            <input type="text" required="" class="form-control" id="email" name="email" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="titulo" id="titulo-t">Telefone: </label><span id="error-email" class="aviso-erro"></span>
                            <input type="text" class="form-control" id="telefone" name="telefone" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="titulo" id="titulo-t">Telefone Residêncial: </label><span id="error-email" class="aviso-erro"></span>
                            <input type="text" class="form-control" id="telRes" name="telRes" >
                        </div>
                    </div>
                    <button class="btn btn-success col-md-12" disabled="">Inscrever-me</button>
                </div>
            </div>




            <div id="aguarde" class="col-md-12">
                <div class="alert alert-danger">Enviando Email de confirmação...Aguarde</div>
                <img src="<?php echo base_url('assets/img/aguarde.gif'); ?>"
            </div>

        </div>
        <div class="modal-footer">                                    
            <a href="<?php echo base_url(''); ?>"<button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Fechar</button></a>
        </div>
    </div>                                                        
</div></div>                                                