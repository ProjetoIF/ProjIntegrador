<?php
# Nome do arquivo: requisicao/list.php
# Objetivo: interface para listagem das requisições do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>
<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Minhas requisições</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="col-9">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>
    <?php if (empty($dados["requisicoes"])) : ?>
        <h3>Você ainda não fez nenhuma requisição</h3>
    <?php else : ?>

        <?php
        // Filtra as requisições por status para exibir os títulos apenas quando necessário
        $naoConcluidas = array_filter($dados["requisicoes"], fn($req) => $req->getStatus() === "PREENCHIMENTO");
        $recusadas = array_filter($dados["requisicoes"], fn($req) => $req->getStatus() === "REJEITADO");
        $emAnalise = array_filter($dados["requisicoes"], fn($req) => in_array($req->getStatus(), ["ENVIADO", "CORRECAO"]));
        $concluidas = array_filter($dados["requisicoes"], fn($req) => $req->getStatus() === "APROVADO");
        ?>

        <?php if (!empty($naoConcluidas)) : ?>
            <div class="row">
                <h3>Minhas requisições não concluídas</h3>
                <?php foreach ($naoConcluidas as $req) : ?>
                    <div class="card m-3 cardReq" style="max-width: 27.5em;">
                        <a href="<?= BASEURL . '/controller/RequisicoesController.php?action=informIngredientes&id=' . $req->getId(); ?>" class="text-decoration-none" style="color: inherit; text-decoration: none;">
                            <div class="row g-0">
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $req->getTurma()->getDisciplina()->getNome(); ?></h5>
                                        <p class="card-text"><small class="text-body-secondary"><?= $req->getTurma()->getNome(); ?></small></p>
                                        <p class="card-text"><?= $req->getDescricao() ?></p>
                                    </div>
                                </div>
                                <div class="col-md-5 border-start" style="border-color: #d3d3d3;">
                                    <div class="p-3">
                                        <p class="card-text bg-dark text-light text-center"><?= (new DateTime($req->getDataAula()))->format('d/m/Y'); ?></p>
                                        <p class="card-text bg-secondary text-light text-center fw-bold">Não concluída</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($recusadas)) : ?>
            <div class="row mt-5">
                <h3>Minhas requisições recusadas</h3>
                <?php foreach ($recusadas as $req) : ?>
                    <div class="card m-3 cardReq" style="max-width: 27.5em;"
                        data-id="<?= $req->getId(); ?>"
                        data-status="<?= $req->getStatus(); ?>"
                        data-motivo="<?= $req->getMotivoDevolucao(); ?>">
                        <div class="row g-0">
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $req->getTurma()->getDisciplina()->getNome(); ?></h5>
                                    <p class="card-text"><small class="text-body-secondary"><?= $req->getTurma()->getNome(); ?></small></p>
                                    <p class="card-text"><?= $req->getDescricao() ?></p>
                                </div>
                            </div>
                            <div class="col-md-5 border-start" style="border-color: #d3d3d3;">
                                <div class="p-3">
                                    <p class="card-text bg-dark text-light text-center"><?= (new DateTime($req->getDataAula()))->format('d/m/Y'); ?></p>
                                    <p class="card-text bg-danger text-light text-center fw-bold"><?= $req->getStatus() ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($emAnalise)) : ?>
            <div class="row mt-5">
                <h3>Minhas requisições em análise</h3>
                <?php foreach ($emAnalise as $req) : ?>
                    <div class="card m-3 cardReq" style="max-width: 27.5em;"
                        data-id="<?= $req->getId(); ?>"
                        data-status="<?= $req->getStatus(); ?>"
                        data-motivo="<?= $req->getMotivoDevolucao(); ?>">
                        <div class="row g-0">
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $req->getTurma()->getDisciplina()->getNome(); ?></h5>
                                    <p class="card-text"><small class="text-body-secondary"><?= $req->getTurma()->getNome(); ?></small></p>
                                    <p class="card-text"><?= $req->getDescricao() ?></p>
                                </div>
                            </div>
                            <div class="col-md-5 border-start" style="border-color: #d3d3d3;">
                                <div class="p-3">
                                    <p class="card-text bg-dark text-light text-center"><?= (new DateTime($req->getDataAula()))->format('d/m/Y'); ?></p>
                                    <p class="card-text bg-warning text-light text-center fw-bold">Em Análise</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($concluidas)) : ?>
            <div class="row mt-5">
                <h3>Minhas requisições concluídas</h3>
                <?php foreach ($concluidas as $req) : ?>
                    <div class="card m-3 cardReq" style="max-width: 27.5em;"
                        data-id="<?= $req->getId(); ?>"
                        data-status="<?= $req->getStatus(); ?>"
                        data-motivo="<?= $req->getMotivoDevolucao(); ?>">
                        <div class="row g-0">
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $req->getTurma()->getDisciplina()->getNome(); ?></h5>
                                    <p class="card-text"><small class="text-body-secondary"><?= $req->getTurma()->getNome(); ?></small></p>
                                    <p class="card-text"><?= $req->getDescricao() ?></p>
                                </div>
                            </div>
                            <div class="col-md-5 border-start" style="border-color: #d3d3d3;">
                                <div class="p-3">
                                    <p class="card-text bg-dark text-light text-center"><?= (new DateTime($req->getDataAula()))->format('d/m/Y'); ?></p>
                                    <p class="card-text bg-success text-light text-center fw-bold">Aprovado</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Conteúdo dinâmico será carregado aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


</div>

<script src="<?= BASEURL ?>/view/requisicao/minhasReq.js"></script>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>