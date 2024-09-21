<?php
#Nome do arquivo: turma/list.php
#Objetivo: interface para listagem das turmas do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Turmas</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn-padrao btn" href="<?= BASEURL ?>/controller/TurmaController.php?action=create">
                <i class="fa-solid fa-plus"></i> Inserir</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <!-- Adiciona a classe table-responsive para tornar a tabela responsiva -->
            <div class="table-responsive">
                <table id="tabTurmas" class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ano de Início</th>
                        <th>Semestre</th>
                        <th>Disciplina</th>
                        <th>Professor</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dados['lista'] as $turma): ?>
                        <tr>
                            <td><?php echo $turma->getId(); ?></td>
                            <td><?= $turma->getNome(); ?></td>
                            <td><?= $turma->getAnoDeInicio(); ?></td>
                            <td><?= $turma->getSemestre(); ?></td>
                            <td><?= $turma->getDisciplina()->getNome(); ?></td>
                            <td><?= $turma->getProfessor()->getNome(); ?></td>
                            <td>
                                <a class="btn btn-primary"
                                   href="<?= BASEURL ?>/controller/TurmaController.php?action=edit&id=<?= $turma->getId() ?>">
                                    Alterar
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger"
                                   onclick="return confirm('Confirma a exclusão da turma?');"
                                   href="<?= BASEURL ?>/controller/TurmaController.php?action=delete&id=<?= $turma->getId() ?>">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div> <!-- Fim da div table-responsive -->
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
