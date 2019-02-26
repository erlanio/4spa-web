<section class="dashboard-header section-padding">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h4>Projetos</h4>
            </div>

            <div class="d-flex align-items-md-stretch">
                <button class="btn btn-primary  offset-md-2 col-md-3" data-toggle="modal" data-target="#cadastro-projeto"><i class="fa fa-plus"></i> Novo Projeto</button>
                <button class="btn btn-info offset-md-1 col-md-3" id="atualizar-tabela-projetos"><i class="fa fa-refresh"></i> Atualizar Dados</button>
            </div>


            <div class="card-body col-md-12">
                <div class="align-items-md-stretch">
                    <table id="tabela-projetos" class="table-hover table-action tabela-projetos">
                        <thead>
                            <tr>
                                <th>#ID</th>                                
                                <th>Projeto</th>

                                <th>Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</section>


<!--MODAL CADASTRO CATEGORIA-->
<div id="cadastro-projeto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Projeto</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-categoria" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Título do Projeto / Aula Prática:</label>
                        <input type="text" class="form-control" id="titulo">
                    </div>


                    <div class="form-group">
                        <label>Resumo do Projeto/Aula:</label>
                        <textarea class="form-control" rows="5" id="resumo"></textarea>
                    </div>


                    <div class="form-group">
                        <label>Objetivos (na íntegra):</label>
                        <textarea class="form-control" rows="5" id="objetivos"></textarea>
                    </div>


                    <div class="form-group">
                        <label>Justificativa:</label>
                        <textarea class="form-control" rows="5" id="justificativa"></textarea>
                    </div>



                    <div class="form-group">
                        <label>Relevância:</label>
                        <textarea class="form-control" rows="5" id="relevancia"></textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Aréa de Conhecimento:</label>
                            <select class="selectpicker form-control" data-live-search="true" id="area" name="subarea" required="">
                                <option>Selecione...</option>
                                <?php
                                foreach ($areas as $area) {
                                    $id = $area->id_area;
                                    $desc = $area->desc_area;

                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>
                            </select>                                     
                        </div>

                        <div class="form-group col-md-6">
                            <label>Subárea de Conhecimento:</label>
                            <select class="form-control selectpicker" data-live-search="true" id="subarea">

                            </select>                                     
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Finalidade Acadêmica do Experimento:</label>
                            <select class="selectpicker form-control" data-live-search="true" id="finalidade" name="subarea" required="">
                                <option>Selecione...</option>
                                <?php
                                foreach ($finalidades as $fin) {
                                    $id = $fin->id_fin_academica;
                                    $desc = $fin->desc_fin_academica;

                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>

                            </select>                
                        </div>

                        <div class="form-group col-md-6">                
                            <label>Sub Finalidade</label>
                            <select class="form-control selectpicker" data-live-search="true" id="subfinalidade">

                            </select>                 
                        </div>


                        <div class="form-group subfinalidade col-md-10" id="ext-form">                
                            <label>Idendifique a atividade aqui:</label>
                            <textarea class="form-control" rows="3" id="outras_finalidades"></textarea>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Início:</label>
                            <input type="date" class="form-control" id="dt_ini">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Fim:</label>
                            <input type="date" class="form-control" id="dt_fim">
                        </div>
                    </div>


                </form>
                <button class="btn btn-success offset-4 col-md-4" id="salvar-projeto">Salvar Alterações</button>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>



<!--MODAL EDITAR CATEGORIA-->
<div id="editar-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Editar Categoria</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Editar Categoria</p>  

                <div id="retorno-edit-categorias"></div>
                <form method="post" action="<?php echo base_url('Categorias/update'); ?>" id="form-categoria-update" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome Categoria</label>
                        <input type="text" placeholder="Nome da Categoria" id="nome-categoria-edit" name="nome-categoria-edit" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição da Categoria</label>
                        <input type="text" placeholder="Descrição da Categoria" id="desc-categoria-edit" name="desc-categoria-edit" class="form-control">
                    </div>

                    <input type="hidden" id="id-categoria-edit" name="id-categoria-edit" value="">

                    <div class="form-group">  
                        Imagem Atual<br>
                        <img src="" id="img-edit" class="img-responsive col-md-2">
                        <input type="file" id="img-categoria-edit" name="img-categoria-edit">

                    </div>

                    <div class="form-group">                               
                        <input type="submit" id="btn-salvar-edicao" onclick="salvarAlteracoesCategoria();" value="Salvar Alterações" class="btn btn-info col-md-12">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>