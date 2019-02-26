

<section class='statis text-center'>
    <div class="container-fluid">
        <div class="row">
            <input type="hidden" id="id_projeto" value="<?php echo $this->uri->segment(3);  ?>">
            <div class="col-md-3 pointer" id="membros">
                <div class="box box-dashboard">
                    <i class="fa fa-user-o"></i>
                    <h3 id="num-membros"><?php echo $numMembros; ?></h3>
                    <p class="lead">Equipe</p>
                </div>
            </div>

            <div class="col-md-3" data-toggle="modal" data-target="#modal-add-animal-experimental">
                <div class="box box-dashboard pointer">
                    <i class="fa fa-paw"></i>
                    <h3></h3>
                    <p class="lead">Informações sobre o Modelo Animal Experimental</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-dashboard">
                    <i class="fa fa-user-o"></i>
                    <h3>245</h3>
                    <p class="lead">User registered</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-dashboard">
                    <i class="fa fa-shopping-cart"></i>
                    <h3>5,154</h3>
                    <p class="lead">Product sales</p>
                </div>
            </div>
   
        </div>
    </div>
</section>

<!--TABELA MEMBROS-->
<div class="card-body col-md-12" hidden="" id="bloco-tabela-membros">
    <button class="btn btn-info offset-md-1 col-md-3" hidden="" id="atualizar-tabela-membros"><i class="fa fa-refresh"></i> Atualizar Dados</button>
    <button class="btn btn-success offset-md-4 col-md-4" data-toggle="modal" data-target="#add-membro"><i class="fa fa-plus"></i> Adicionar novo membro</button>
    <div class="align-items-md-stretch">
        <table id="tabela-membros" class="table-hover table-action col-md-12">
            <thead>
                <tr>
                    <th>#ID</th>                                
                    <th>Nome</th>
                    <th>Função</th>

                    <th>Opções</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!--TABELA MEMBROS-->