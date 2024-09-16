<?php
#Nome do arquivo: requsicao/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="font-weight-bold poppins-extrabold">Requisições</h3>
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
            <table id="tabUsuarios" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Data da Aula</th>
                        <th>Status da requisição</th>
                        <th>Turma</th>
                        <th>Motivo Devolução</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['lista'] as $req): ?>
                        <tr>
                            <td><?= $req->getId(); ?></td>
                            <td><?= $req->getDescricao(); ?></td>
                            <td><?= $req->getDataAula(); ?></td>
                            <td><?= $req->getStatus(); ?></td>
                            <td><?= $req->getIdTurma(); ?></td>
                            <td><?= $req->getMotivoDevolucao(); ?></td>
                            <td><a class="btn btn-primary"
                                href="<?= BASEURL ?>/controller/RequisicaoController.php?action=edit&id=<?= $req->getId() ?>">
                                Alterar</a> 
                            </td>
                            <td><a class="btn btn-danger" 
                                onclick="return confirm('Confirma a exclusão da requisição?');"
                                href="<?= BASEURL ?>/controller/RequisicaoController.php?action=delete&id=<?= $req->getId() ?>">
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
