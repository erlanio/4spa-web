<div class="login-page">
    <div class="form">
        <div id="retorno-login"></div>

        <form class="register-form" onsubmit="return false">
            <input type="text" placeholder="Nome" id="nome" name="nome" required=""/>
            <input type="email" placeholder="Email" id="email" name="email" required=""/>
            <input type="password" placeholder="Senha" id="senha" name="senha" required=""/>
            <input type="text" id="reoete-senha" name="repeteSenha" placeholder="Repete Senha" required=""/>

      


            <button id="btn-cadastro">Criar Cadastro</button>
            <p class="message">Já tem cadastro? <a href="#" class="cadastro">Fazer Login</a></p>
        </form>
        <form class="login-form" onsubmit="return false">
            <input type="text" id="login-email" name="email" placeholder="Email"/>
            <input type="password" id="login-senha" name="senha" placeholder="Senha"/>
            <button id="btn-logar">login</button>
            <br><br>
            <button class="cadastro">Cadastre-se</button>
            <br><br>
            <button class="cadastro">Recuperar senha</button>
        </form>
    </div>
</div>

<script>
</script>