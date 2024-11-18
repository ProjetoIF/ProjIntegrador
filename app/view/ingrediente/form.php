<?php
#Nome do arquivo: ingrediente/list.php
#Objetivo: interface para inserção/alteração de ingredientes

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">
        <?php if ($dados['id'] == 0) echo "Inserir";
        else echo "Alterar"; ?>
        Ingrediente
    </h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row" style="margin-top: 10px;">

        <div class="frm-centralize col">
            <form class="frm-style" id="frmIngrediente" method="POST"
                action="<?= BASEURL ?>/controller/IngredienteController.php?action=save"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtNome"><i class="fa-solid fa-utensils"></i> Nome do ingrediente:</label>
                    <input class="form-control frm-input" type="text" id="txtNome" name="nome"
                        maxlength="45" placeholder="Informe o nome do ingrediente"
                        value="<?php echo (isset($dados["ingrediente"]) ? $dados["ingrediente"]->getNome() : ''); ?>" />
                </div>

                <div class="form-group">
                    <label for="txtUnidade"><i class="fa-solid fa-balance-scale"></i> Unidade de medida:</label>
                    <select class="form-control frm-input" name="unidadeDeMedidaId" id="selUnidade">
                        <option value="">--Selecione Unidade de medida--</option>
                        <?php foreach ($dados["unidades"] as $unidade): ?>
                            <option value="<?= $unidade->getId() ?>"
                                <?php if (isset($dados["ingrediente"]) && $dados["ingrediente"]->getUnidadeDeMedida() && $dados["ingrediente"]->getUnidadeDeMedida()->getId() == $unidade->getId()) echo "selected"; ?>>
                                <?= $unidade->getNome() . " (" . $unidade->getSigla() . ")" ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="areaDesc"><i class="fa-solid fa-file-alt"></i> Descrição:</label>
                    <textarea class="form-control frm-input" name="descricao" id="areaDesc" cols="30" rows="10" placeholder="Insira a descrição do ingrediente"><?php echo (isset($dados["ingrediente"]) ? $dados["ingrediente"]->getDescricao() : ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="ImgIngrediente"><i class="fa-solid fa-image"></i> Imagem:</label>

                    <!-- Exibir imagem existente, se houver -->
                    <?php if (isset($dados["ingrediente"]) && $dados["ingrediente"]->getCaminhoImagem()) : ?>
                        <div class="current-image">
                            <img src="<?= BASEURL_ING_IMG . $dados["ingrediente"]->getCaminhoImagem(); ?>" alt="Imagem Atual do Ingrediente" style="max-width: 200px; margin-bottom: 10px;">
                        </div>
                    <?php endif; ?>

                    <!-- Campo de upload para nova imagem -->
                    <input class="form-control frm-input" type="file" id="ImgIngrediente" name="imagem" accept="image/*" />
                </div>


                <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />
                <?php
                if ($dados['id'] != 0) {
                    echo '<input type="hidden" id="hddImg" name="imgPath" value="' . $dados['ingrediente']->getCaminhoImagem() . '" />';
                }
                ?>


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
            <a class="btn btn-secondary" href="<?php /*= BASEURL */ ?>/controller/IngredienteController.php?action=list">Voltar</a>
        </div>
    </div>-->

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>