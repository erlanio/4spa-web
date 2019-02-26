<section class="dashboard-header section-padding">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h4>Meus Dados</h4>
            </div>                               
        </div>

        <form method="post" action="<?php echo base_url('Categorias/salvar'); ?>" id="form-categoria" onsubmit="return false" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->nome_pessoa; ?>">
            </div>


            <div class="form-group">
                <label>Email:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->email_pessoa; ?>">
            </div>

            <div class="form-group">
                <label>Senha:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="***********">
            </div>

            <div class="form-group">
                <label>CPF:</label>
                <input type="text" id="cpf" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->cpf_pessoa; ?>">
            </div>

            <div class="form-group">
                <label>RG:</label>
                <input type="text" id="rg" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->rg_pessoa; ?>">
            </div>
            
            <div class="form-group">
                <label>Link Lattes:</label>
                <input type="text" id="rg" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->lattes; ?>">
            </div>

            <div class="form-group">
                <label>Telefone:</label>
                <input type="text" id="telefone" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->telefone; ?>">
            </div>

            <div class="form-group">
                <label>Estado:</label>
                <select class="form-control" id="estado" name="estado" required="">

                    <?php
                    foreach ($estados as $result) {
                        $id_estado = $result->id;
                        $sigla = $result->sigla;

                        if ($this->session->userdata('usuario')->id_estado == $id_estado) {
                            echo "<option value='$id_estado' selected>$result->nome</option>";
                        } else {
                            echo "<option value='$id_estado'>$result->nome</option>";
                        }
                    }
                    ?>
                </select>                                     
            </div>

            <div class="form-group">
                <label>Cidade:</label>
                <select class="form-control" id="cidades" name="cidades"  disabled>
                    <?php
                    foreach ($cidade as $cid) {
                        $id_cidade = $cid->id;
                        $nome = $cid->nome;
                        echo "<option value='$id_estado'>$nome</option>";
                    }
                    ?>
                </select>                                     
            </div>

            <div class="form-group">
                <label>Telefone:</label>
                <input type="text" id="telefone" name="nome" class="form-control" value="<?php echo $this->session->userdata('usuario')->rua; ?>">
            </div>

        </form>
        
        <button class="btn btn-success offset-4 col-md-4">Salvar Alterações</button>
</section>

