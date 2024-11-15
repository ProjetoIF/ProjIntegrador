<?php
#Nome do arquivo: unidadeDeMedida/form.php
#Objetivo: interface para inserção/edição de Unidade de Medida

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">
        <?php if ($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?> Unidade de Medida
    </h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="frm-centralize col">
            <form class="frm-style" id="frmUnidadeDeMedida" method="POST" 
                  action="<?= BASEURL ?>/controller/UnidadeDeMedidaController.php?action=save">

                <div class="form-group">
                    <label for="txtNome"><i class="fa-solid fa-users"></i> Nome:</label>
                    <input class="form-control frm-input" type="text" id="txtNome" name="nome" maxlength="200"
                           placeholder="Informe a Unidade de Medida"
                           value="<?php echo isset($dados['unidade']) ? $dados['unidade']->getNome() : ''; ?>" />
                </div>

                <div class="form-group">
                    <label for="txtSigla"><i class="fa-solid fa-book"></i> Sigla:</label>
                    <input class="form-control frm-input" type="text" id="txtSigla" name="sigla" maxlength="10"
                           placeholder="Informe a Sigla"
                           value="<?php echo isset($dados['unidade']) ? $dados['unidade']->getSigla() : ''; ?>" />
                </div>

                <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />

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
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>