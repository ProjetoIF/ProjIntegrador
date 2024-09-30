<?php
#Nome do arquivo: requisicao/list.php
#Objetivo: interface para listagem das requisições do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
    <div class="nav-pages">
        <h3 class="nav-pages-title font-weight-bold poppins-extrabold">
            <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?>
            Requisição
        </h3>
        <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
    </div>

    <div class="container">

        <div class="row" style="margin-top: 10px;">

            <div class="frm-centralize col">
                <form class="frm-style" method="POST"
                      action="<?= BASEURL ?>/controller/RequisicoesController.php?action=save" >

                    <div class="form-group">
                        <label for="dataAula"> <i class="fa-solid fa-calendar"></i> Data da aula:</label>
                        <input class="form-control frm-input" type="date" id="dataAula" name="dataAula"
                               maxlength="45" placeholder="Informe a data da aula"
                               value="<?php echo (isset($dados["dataAula"]) ? $dados["dataAula"]->getDataAula() : ''); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="txtSenha"><i class="fa-solid fa-graduation-cap"></i> Turma:</label>
                        <select class="form-control frm-input" id="selTurma" name="turma">
                            <option value="">--Selecione a Turma--</option>
                            <?php foreach($dados["turmas"] as $turma): ?>
                                <option value="<?= $turma->getId() ?>"
                                    <?php if (isset($dados["turma"]) && $dados["turma"]->getIdTurma() == $turma->getId()) echo "selected"; ?>
                                >
                                    <?= $turma->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="areaDesc"><i class="fa-solid fa-file-alt"></i> Descrição:</label>
                        <textarea class="form-control frm-input" name="descricao" id="areaDesc" cols="30" rows="10" placeholder="Insira a descrição da requisição"><?php echo (isset($dados["descricao"]) ? $dados["descricao"]->getDescricao() : ''); ?></textarea>
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