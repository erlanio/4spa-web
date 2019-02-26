<section class="dashboard-header section-padding">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h4>Novo Projeto</h4>
            </div>                               
        </div>

        <input type="text" id="id_projeto">


        <div class="accordion">
            <h3 class="accordion-toggle" id="titulo-projeto">IDENTIFICAÇÃO DO EXPERIMENTO <span class="arrow"></span></h3>
            <div class="accordion-content default " id="projeto">


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


            <h3 class="accordion-toggle" id="equipe">EQUIPE<span class="arrow"></span></h3>
            <div class="accordion-content">

                <button class="btn btn-primary col-md-3" data-toggle="modal" data-target="#cadastro-projeto"><i class="fa fa-plus"></i> Adicionar Membro</button>                                

                <div class="card-body col-md-12">
                    <div class="align-items-md-stretch">
                        <table id="tabela-membros" class="table-hover table-action tabela-marcas">
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

            </div>



            <h3 class="accordion-toggle">INFORMAÇÕES SOBRE O MODELO ANIMAL EXPERIMENTAL<span class="arrow"></span></h3>
            <div class="accordion-content">

            </div>

            <h3 class="accordion-toggle">PROCEDIMENTOS EXPERIMENTAIS<span class="arrow"></span></h3>
            <div class="accordion-content">

            </div>

            <h3 class="accordion-toggle">PROCEDIMENTOS LABORATORIAIS<span class="arrow"></span></h3>
            <div class="accordion-content">

            </div>

            <h3 class="accordion-toggle">PROCEDIMENTOS DE EUTANASIA<span class="arrow"></span></h3>
            <div class="accordion-content">

            </div>

            <h3 class="accordion-toggle">TERMO DE RESPONSABILIDADE<span class="arrow"></span></h3>
            <div class="accordion-content">

            </div>

            <h3 class="accordion-toggle">SUGESTÕES DE ITENS DE INCLUSÃO NO FORMULÁRIO<span class="arrow"></span></h3>
            <div class="accordion-content">

            </div>


        </div>


    </div>
</section>
