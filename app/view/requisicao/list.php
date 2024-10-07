<?php
#Nome do arquivo: requsicao/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Requisições</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn-padrao btn"
                href="<?= BASEURL ?>/controller/RequisicoesController.php?action=create">
                <i class="fa-solid fa-plus"></i> Inserir</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tabUsuarios" class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Data da Aula</th>
                        <th>Status da requisição</th>
                        <th>Turma</th>
                        <th>Motivo Devolução</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dados['lista'] as $req): ?>
                        <tr>
                            <td><?= $req->getId(); ?></td>
                            <td><?= $req->getDescricao(); ?></td>
                            <td><?= $req->getDataAula(); ?></td>
                            <td><?= $req->getStatus(); ?></td>
                            <td><?= $req->getTurma()->getNome(); ?></td>
                            <td><?= $req->getMotivoDevolucao(); ?></td>
                            <td><a class="btn btn-primary"
                                   href="<?= BASEURL ?>/controller/RequisicoesController.php?action=edit&id=<?= $req->getId() ?>">
                                   <i class="fa-regular fa-pen-to-square"></i> Alterar</a>
                            </td>
                            <td><a class="btn btn-danger"
                                   onclick="return confirm('Confirma a exclusão da requisição?');"
                                   href="<?= BASEURL ?>/controller/RequisicoesController.php?action=delete&id=<?= $req->getId() ?>">
                                   <i class="fa-solid fa-trash-can"></i> Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
