<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">
        <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
        Usuário
    </h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">

    <div class="row" style="margin-top: 10px;">

        <div class="frm-centralize col">
            <form class="frm-style" method="POST"
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=save" >
                <div class="form-group">
                    <label for="txtNome"> <i class="fa-solid fa-user"></i> Nome comlpeto:</label>
                    <input class="form-control frm-input" type="text" id="txtNome" name="nome"
                        maxlength="200" placeholder="Informe o nome completo"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>" />
                </div>

                <div class="form-group">
                    <label for="txtLogin"> <i class="fa-solid fa-right-to-bracket"></i> Login:</label>
                    <input class="form-control frm-input" type="text" id="txtLogin" name="login"
                        maxlength="45" placeholder="Informe o login"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getLogin() : ''); ?>"/>
                </div>

                <div class="form-group">
                    <label for="txtSenha"><i class="fa-solid fa-lock"></i> Senha:</label>
                    <input class="form-control frm-input" type="password" id="txtPassword" name="senha"
                        maxlength="200" placeholder="Informe a senha"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>"/>
                </div>

                <div class="form-group">
                    <label for="txtConfSenha"><i class="fa-solid fa-lock"></i> Confirmação da senha:</label>
                    <input class="form-control frm-input" type="password" id="txtConfSenha" name="conf_senha"
                        maxlength="200" placeholder="Informe a confirmação da senha"
                        value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : '';?>"/>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-chalkboard-user"></i> Papel</label>
                    <select class="form-control frm-input" name="papel" id="selPapel">
                        <option value="">Selecione o papel</option>
                        <?php foreach($dados["papeis"] as $papel): ?>
                            <option value="<?= $papel ?>"
                                <?php
                                    if(isset($dados["usuario"]) && $dados["usuario"]->getPapel() == $papel)
                                        echo "selected";
                                ?>
                            >
                                <?= $papel ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="txtTelefone"><i class="fa-solid fa-phone"></i> Telefone:</label>
                    <input class="form-control frm-input" type="text" id="txtTelefone" name="telefone"
                           maxlength="45" placeholder="Informe o telefone"
                           value="<?php echo isset($dados['telefone']) ? $dados['telefone'] : '';?>"/>
                </div>
                <div class="form-group">
                    <label for="txtEmail"><i class="fa-solid fa-envelope"></i> Email:</label>
                    <input class="form-control frm-input" type="text" id="txtEmail" name="email"
                           maxlength="100" placeholder="Informe o email"
                           value="<?php echo isset($dados['email']) ? $dados['email'] : '';?>"/>
                </div>

                <div class="form-group">
                    <label for="ImgUsuario"><i class="fa-solid fa-image"></i> Imagem:</label>

                    <!-- Exibir imagem existente, se houver -->
                    <?php if (isset($dados["usuario"]) && $dados["usuario"]->getCaminhoImagem()) : ?>
                        <div class="current-image">
                            <img src="<?= BASEURL_USER_IMG . $dados["usuario"]->getCaminhoImagem(); ?>" alt="Imagem Atual do Usuario" style="max-width: 200px; margin-bottom: 10px;">
                        </div>
                    <?php endif; ?>

                    <!-- Campo de upload para nova imagem -->
                    <input class="form-control frm-input" type="file" id="ImgUsuario" name="imagem" accept="image/*" />
                </div>

                <input type="hidden" id="hddId" name="id"
                    value="<?= $dados['id']; ?>" />
                <div style="flex-direction: row">
                    <button type="reset" class="btn btn-clear">Limpar</button>
                    <button type="submit" class="btn btn-padrao" style="display: inline-flex">Gravar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row frm-centralize" style="margin-top: 2em;">
        <div class="col-8">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <!--<div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary"
                href="<?php /*= BASEURL */?>/controller/UsuarioController.php?action=list">Voltar</a>
        </div>
    </div>--> <!--Talvez esse botão volte-->


</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>