<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">Disciplinas</h3>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success"
                href="<?= BASEURL ?>/controller/DisciplinaController.php?action=create">
                Inserir</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="tabUsuarios" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Carga horária</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['lista'] as $disci): ?>
                        <tr>
                            <td><?php echo $disci->getId(); ?></td>
                            <td><?= $disci->getNome(); ?></td>
                            <td><?= $disci->getCargaHoraria(); ?></td>
                            <td><a class="btn btn-primary"
                                href="<?= BASEURL ?>/controller/DisciplinaController.php?action=edit&id=<?= $disci->getId() ?>">
                                Alterar</a>
                            </td>
                            <td><a class="btn btn-danger"
                                onclick="return confirm('Confirma a exclusão do usuário?');"
                                href="<?= BASEURL ?>/controller/DisciplinaController.php?action=delete&id=<?= $disci->getId() ?>">
                                Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
