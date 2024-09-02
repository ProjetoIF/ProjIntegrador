<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>

<div class="">
    <div class="row">
        <div class=" min-vh-100 col-7" style="background-color: #1A222F">

        </div>
        <div class="col-5 d-flex justify-content-center mt-5">
            <div class="">
                <h1 class="text-center font-weight-bold poppins-extrabold">Seja bem vindo!</h1>
                <h4 class="text-center">Faça seu login</h4>
                <br>

                <!-- Formulário de login -->
                <form id="frmLogin" action="./LoginController.php?action=logon" method="POST" >
                    <div class="form-group">
                        <input type="text" class="form-control login-inputs mt-3" name="login" id="txtLogin"
                            maxlength="15" placeholder="Informe o login"
                            value="<?php echo isset($dados['login']) ? $dados['login'] : '' ?>"/>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control login-inputs mt-3" name="senha" id="txtSenha"
                            maxlength="15" placeholder="Informe a senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />
                    </div>

                    <button type="submit" class="btn mt-3" id="btn-login">Logar</button>
                </form>
                <?php include_once(__DIR__ . "/../include/msg.php") ?>

                <div class="alert alert-primary">
                    Teste
                </div>
            </div>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
