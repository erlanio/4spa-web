<section class="dashboard-header section-padding">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h4>Administrar Marcas </h4>
            </div>

            <div class="d-flex align-items-md-stretch">
                <button class="btn btn-primary offset-md-2 col-md-3" data-toggle="modal" data-target="#cadastro-marcas"><i class="fa fa-plus"></i> Nova Marca</button>
                <button class="btn btn-info offset-md-1 col-md-3" id="atualizar-tabela-marcas"><i class="fa fa-refresh"></i> Atualizar Dados</button>
            </div>


            <div class="card-body col-md-12">
                <div class="align-items-md-stretch">
                    <table id="tabela-marcas" class="table-hover table-action tabela-marcas">
                        <thead>
                            <tr>
                                <th>#ID</th>                                
                                <th>Marcas</th>
                                <th>Descrição</th>
                                <th>Produto</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</section>


<!--MODAL CADASTRO marcas-->
<div id="cadastro-marcas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Marca</h5
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div id="retorno-salvar-marcas"></div>
                <form method="post" action="<?php echo base_url('marcas/salvar'); ?>" id="form-marcas" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome marcas</label>
                        <input type="text" placeholder="Nome da Marca" id="nome-marcas" name="nome-marcas" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição da Marca</label>
                        <input type="text" placeholder="Descrição da Marca" id="desc-marcas" name="desc-marcas" class="form-control">
                    </div>


                    <div class="form-group">     
                        <label>Tipo de Produto</label>
                        <select class="form-control" name="id-produto-marcas" id="id-produto-marcas">
                            <?php foreach ($produtos as $produto) { ?>
                                <option value="<?php echo $produto->id_produto; ?>"><?php echo $produto->nome_produto; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">   

                        <div id="retorno-imagem-marcas"></div>
                        <label>Imagem da Marca</label>
                        <input type="file" id="img-marcas" name="img-marcas" placeholder="Descrição da Marca" id="imagem-marcas" class="form-control">

                    </div>
                    <div class="form-group">       
                        <input type="submit" value="Salvar Marca" id="btn-salvar-marcas" class="btn btn-primary col-md-12" disabled="">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>



<!--MODAL EDITAR marcas-->
<div id="editar-marcas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Editar Marcas</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Editar marcas</p>  

                <form method="post" action="<?php echo base_url('marcas/update'); ?>" id="form-marcas-update" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome marcas</label>
                        <input type="text" placeholder="Nome da marcas" id="nome-marcas-edit" name="nome-marcas-edit" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição da marcas</label>
                        <input type="text" placeholder="Descrição da marcas" id="desc-marcas-edit" name="desc-marcas-edit" class="form-control">
                    </div>

                    <div class="form-group">     
                        <label>Tipo de Produto</label>
                        <select class="form-control" name="produto-marcas-edit" id="produto-marcas-edit">
                            <?php foreach ($produtos as $produto) { ?>
                                <option value="<?php echo $produto->id_produto; ?>"><?php echo $produto->nome_produto; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" id="id-marcas-edit" name="id-marcas-edit" value="">

                    <div class="form-group">  
                        Imagem Atual<br>
                        <img src="" id="img-edit" class="img-responsive col-md-2">
                        <input type="file" id="img-marcas-edit" name="img-marcas-edit">

                    </div>

                    <div class="form-group">                               
                        <input type="submit" id="btn-salvar-edicao" onclick="salvarAlteracoesMarcas();" value="Salvar Alterações" class="btn btn-info col-md-12">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>
