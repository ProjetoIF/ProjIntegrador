<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

    <h3 class="text-center">
        <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
        Disciplina
    </h3>

    <div class="container">

        <div class="row" style="margin-top: 10px;">

            <div class="col-6">
                <form id="frmDisciplina" method="POST"
                      action="<?= BASEURL ?>/controller/DisciplinaController.php?action=save" >
                    <div class="form-group">
                        <label for="txtNome">Nome da disciplina:</label>
                        <input class="form-control" type="text" id="txtNome" name="nome"
                               maxlength="45" placeholder="Informe o nome da disciplina"
                               value="<?php echo (isset($dados["disciplina"]) ? $dados["disciplina"]->getNome() : ''); ?>" />
                    </div>

                    <div class="form-group">
                        <label for="txtLogin">Carga horária:</label>
                        <input class="form-control" type="number" id="intCargaHoraria" name="cargaHoraria" min="1"
                               value="<?php echo (isset($dados["disciplina"]) ? $dados["disciplina"]->getCargaHoraria() : ''); ?>"/>
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
                   href="<?= BASEURL ?>/controller/DisciplinaController.php?action=list">Voltar</a>
            </div>
        </div>
    </div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>