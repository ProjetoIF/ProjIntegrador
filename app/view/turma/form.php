<?php
#Nome do arquivo: turma/form.php
#Objetivo: interface para inserção de informações de turma

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">Inserir Turma</h3>

<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="col-6">
            <form id="frmTurma" method="POST" action="<?= BASEURL ?>/controller/TurmaController.php?action=save">
                <div class="form-group">
                    <label for="txtNome">Nome:</label>
                    <input class="form-control" type="text" id="txtNome" name="nome" maxlength="200" placeholder="Informe o nome da turma"/>
                </div>
                
                <div class="form-group">
                    <label for="txtDataInicio">Data de Início:</label>
                    <input class="form-control" type="date" id="txtDataInicio" name="data_inicio"/>
                </div>

                <div class="form-group">
                    <label for="txtSemestre">Semestre:</label>
                    <input class="form-control" type="text" id="txtSemestre" name="semestre" maxlength="45" placeholder="Informe o semestre"/>
                </div>

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
            <a class="btn btn-secondary" href="<?= BASEURL ?>/controller/TurmaController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
