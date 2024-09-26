<?php
#Nome do arquivo: turma/form.php
#Objetivo: interface para inserção de informações de turma

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">
        <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
        Turma
    </h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">

    <div class="row" style="margin-top: 10px;">

        <div class="frm-centralize col">
            <form class="frm-style" id="frmTurma" method="POST" action="<?= BASEURL ?>/controller/TurmaController.php?action=save">
                <div class="form-group">
                    <label for="txtNome"><i class="fa-solid fa-users"></i> Nome:</label>
                    <input class="form-control frm-input" type="text" id="txtNome" name="nome" maxlength="200"
                           placeholder="Informe o nome da turma"
                           value="<?php echo (isset($dados["turma"]) ? $dados["turma"]->getNome() : ''); ?>"/>
                </div>

                <div class="form-group">
                    <label for="txtAnoInicio"><i class="fa-solid fa-calendar-alt"></i> Ano de Início:</label>
                    <input class="form-control frm-input" type="number" id="txtAnoInicio" name="anoInicio" min="1900" max="2100"
                           placeholder="Informe o ano de início"
                           value="<?php echo (isset($dados["turma"]) ? $dados["turma"]->getAnoDeInicio() : ''); ?>"/>
                </div>

                <div class="form-group">
                    <label for="txtSemestre"><i class="fa-solid fa-calendar"></i> Semestre:</label>
                    <input class="form-control frm-input" type="number" id="intSemestre" min="1" name="semestre"
                           placeholder="Informe o semestre"
                           value="<?php echo (isset($dados["turma"]) ? $dados["turma"]->getSemestre() : ''); ?>"/>
                </div>

                <div class="form-group">
                    <label for="idDisciplina"><i class="fa-solid fa-book"></i> Disciplina:</label>
                    <select class="form-control frm-input" id="selDisciplina" name="disciplina">
                        <option value="">--Selecione a Disciplina--</option>
                        <?php foreach($dados["disciplinas"] as $disciplina): ?>
                            <option value="<?= $disciplina->getId() ?>"
                                <?php if (isset($dados["turma"]) && $dados["turma"]->getIdDisciplina() == $disciplina->getId()) echo "selected"; ?>
                            >
                                <?= $disciplina->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idProfessor"><i class="fa-solid fa-chalkboard-teacher"></i> Professor:</label>
                    <select class="form-control frm-input" name="professor" id="selProfessor">
                        <option value="">--Selecione o professor--</option>
                        <?php foreach($dados["professores"] as $professor): ?>
                            <option value="<?= $professor->getId() ?>"
                                <?php if (isset($dados["turma"]) && $dados["turma"]->getIdProfessor() == $professor->getId()) echo "selected"; ?>
                            >
                                <?= $professor->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
            <a class="btn btn-secondary" href="<?php /*= BASEURL */?>/controller/TurmaController.php?action=list">Voltar</a>
        </div>
    </div>-->

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
