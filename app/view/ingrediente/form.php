<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

    <h3 class="text-center">
        <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
        Ingrediente
    </h3>

    <div class="container">

        <div class="row" style="margin-top: 10px;">

            <div class="col-6">
                <form id="frmIngrediente" method="POST"
                      action="<?= BASEURL ?>/controller/IngredienteController.php?action=save" >
                    <div class="form-group">
                        <label for="txtNome">Nome do ingrediente:</label>
                        <input class="form-control" type="text" id="txtNome" name="nome"
                               maxlength="45" placeholder="Informe o nome do ingrediente"
                               value="<?php echo (isset($dados["ingrediente"]) ? $dados["ingrediente"]->getNome() : ''); ?>" />
                    </div>

                    <div class="form-group">
                        <label for="txtUnidade">Unidade de medida:</label>
                        <select name="unidadeDeMedida" id="selUnidade" class="form-control">
                            <option value="">--Insira uma unidade de medida--</option>
                            <option value="ml" <?php echo (isset($dados["ingrediente"]) && $dados["ingrediente"]->getUnidadeDeMedida() === 'ml' ? 'selected' : ''); ?>>Mililitros (ml)</option>
                            <option value="lt" <?php echo (isset($dados["ingrediente"]) && $dados["ingrediente"]->getUnidadeDeMedida() === 'lt' ? 'selected' : ''); ?>>Litros (lt)</option>
                            <option value="kg" <?php echo (isset($dados["ingrediente"]) && $dados["ingrediente"]->getUnidadeDeMedida() === 'kg' ? 'selected' : ''); ?>>Quilogramas (kg)</option>
                            <option value="gr" <?php echo (isset($dados["ingrediente"]) && $dados["ingrediente"]->getUnidadeDeMedida() === 'gr' ? 'selected' : ''); ?>>Gramas (gr)</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="txtDescricao">Descrição:</label>
                        <textarea class="form-control" name="descricao" id="areaDesc" cols="30" rows="10" placeholder="Insira a descrição do ingrediente"><?php echo (isset($dados["ingrediente"]) ? $dados["ingrediente"]->getDescricao() : ''); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtImg">Caminho da imagem</label>
                        <input class="form-control" type="text" id="txtImgCaminho" name="caminhoImagem"
                               maxlength="45" placeholder="Informe o caminho da imagem"
                               value="<?php echo (isset($dados["ingrediente"]) ? $dados["ingrediente"]->getCaminhoImagem() : ''); ?>" />
                    </div>

                    <input type="hidden" id="hddId" name="id"
                           value="<?= $dados['id']; ?>" />

                    <button type="submit" class="btn btn-success">Gravar</button>
                    <button type="reset" class="btn btn-danger">Limpar</button>
                </form>
            </div>

            <div class="col-6">
                <?php require_once(__DIR__ . "/../include/msg.php"); ?>
            </div>
        </div>

        <div class="row" style="margin-top: 30px;">
            <div class="col-12">
                <a class="btn btn-secondary"
                   href="<?= BASEURL ?>/controller/IngredienteController.php?action=list">Voltar</a>
            </div>
        </div>
    </div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>