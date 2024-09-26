<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">
        <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
        Disciplina
    </h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">

    <div class="row" style="margin-top: 10px;">

        <div class="frm-centralize col">
            <form class="frm-style" method="POST"
                  action="<?= BASEURL ?>/controller/DisciplinaController.php?action=save" >
                <div class="form-group">
                    <label for="txtNome"><i class="fa-solid fa-book"></i> Nome da disciplina:</label>
                    <input class="form-control frm-input" type="text" id="txtNome" name="nome"
                           maxlength="45" placeholder="Informe o nome da disciplina"
                           value="<?php echo (isset($dados["disciplina"]) ? $dados["disciplina"]->getNome() : ''); ?>" />
                </div>

                <div class="form-group">
                    <label for="intCargaHoraria"><i class="fa-solid fa-clock"></i> Carga horária:</label>
                    <input class="form-control frm-input" type="number" id="intCargaHoraria" name="cargaHoraria" min="1"
                           placeholder="Informe a carga horária"
                           value="<?php echo (isset($dados["disciplina"]) ? $dados["disciplina"]->getCargaHoraria() : ''); ?>"/>
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

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
