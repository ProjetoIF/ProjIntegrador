<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<div>
    <div class="row">
        <div id="lateral-content-login" class="lateral-content-login min-vh-100 col-7 d-flex justify-content-center" style="background-color: #1A222F">
            <img class="img-fluid h-50" style="margin-top: 10rem;" src="<?=BASEURL. "/assets/img/logo-login.png"?>" alt="">
        </div>
        <div class="login-content col-5 d-flex justify-content-center mt-5">
            <h3 id="form-login-tittle"></h3>
            <div id="form-login">
                <h1 class="text-center font-weight-bold poppins-extrabold">Seja bem vindo!</h1>
                <h4 class="text-center">Faça seu login</h4>
                <br>

                <!-- Formulário de login -->
                <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">
                    <div class="form-group input-container">
                        <i class="fas fa-user"></i> <!-- Ícone de usuário -->
                        <input type="text" class="form-control login-inputs mt-3" name="login" id="txtLogin"
                               maxlength="15" placeholder="Informe o login"
                               value="<?php echo isset($dados['login']) ? $dados['login'] : '' ?>" />
                    </div>

                    <div class="form-group input-container">
                        <i class="fas fa-lock"></i> <!-- Ícone de cadeado para senha -->
                        <input type="password" class="form-control login-inputs mt-3" name="senha" id="txtSenha"
                               maxlength="15" placeholder="Informe a senha"
                               value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />
                    </div>

                    <button type="submit" class="btn mt-3" id="btn-login">Logar</button>
                </form>

                <div class="mt-3">
                    <?php include_once(__DIR__ . "/../include/msg.php") ?>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    body, html {
    overflow: hidden;
}

</style>


<?php
require_once(__DIR__ . "/../include/footer.php");
?>
