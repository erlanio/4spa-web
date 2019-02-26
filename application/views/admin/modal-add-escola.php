<!--modal-add-animal-experimental-->
<div id="modal-add-escola" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Adicionar nova escola</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div id="retorno-salvar-escola"></div>

                <form method="post" enctype="multipart/form-data" onsubmit="return false">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nome da escola: </label>
                            <input type="text" class="form-control" id="escola" name="nomeEscola">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Telefone: </label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Tipo de escola:</label>
                            <select class="form-control selectpicker" data-live-search="true" id="tipoEscola" name="tipo">
                                <option value="selecione">Selecione...</option>
                                <?php
                                foreach ($tipoEscolas as $tipo) {
                                    $id = $tipo->id_tipo_escola;
                                    $desc = $tipo->descricao;
                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-md-4">
                            <label>Estado: </label>
                            <select class="form-control selectpicker" data-live-search="true" id="estado" name="estado">
                                <option value="selecione">Selecione...</option>
                                <?php
                                foreach ($estados as $r) {
                                    $id = $r->id;
                                    $desc = $r->nome;
                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-md-4">
                            <label>Cidade: </label>
                            <select class="form-control selectpicker" data-live-search="true" id="cidades" name="cidade">
                                <option value="selecione">Selecione...</option>
                            </select> 
                        </div>                       
                    </div>

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label>Bairro: </label>
                            <input type="text" class="form-control" id="bairro" name="bairro">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Rua: </label>
                            <input type="text" class="form-control" id="rua" name="rua">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Nº: </label>
                            <input type="text" class="form-control" id="num" name="numero">
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Email: </label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>

                    </div>

                    <button class="btn btn-success offset-md-4 col-md-4" id="salvar-escola">Salvar Escola</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>