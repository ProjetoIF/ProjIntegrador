<?php
#Nome do arquivo: requsicao/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Gerenciar Requisições</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="col-9">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>
    <?php if (empty($dados["requisicoes"])) : ?>
        <h3>Ainda nenhuma requisição foi subetida</h3>
    <?php else : ?>

        <?php
        $emAnalise = array_filter($dados["requisicoes"], fn($req) => in_array($req->getStatus(), ["ENVIADO", "CORRECAO"]));
        ?>

        <?php if (!empty($emAnalise)) : ?>
            <div class="row mt-5">
                <h3>Requisições submetidas para análise</h3>
                <?php foreach ($emAnalise as $req) : ?>
                    <div class="card m-3 cardReq" style="max-width: 27.5em;" data-id="<?= $req->getId() ?>" data-disciplina="<?= $req->getTurma()->getDisciplina()->getNome(); ?>" data-turma="<?= $req->getTurma()->getNome(); ?>"
                        data-req="<?= (new DateTime($req->getDataAula()))->format('d/m/Y'); ?>" data-prof="<?= $req->getTurma()->getProfessor()->getNome(); ?>" data-desc="<?= $req->getDescricao(); ?>">
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
    <?php endif; ?>
    <!-- Modal -->
    <div class="modal fade" id="modalIngredientes" tabindex="-1" aria-labelledby="modalIngredientesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalIngredientesLabel">Ingredientes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Informações da requisição -->
                    <p><strong>Data da aula: </strong><span id="dataReq"></span></p>
                    <p><strong>Professor: </strong><span id="nomeProfessorId"></span></p>
                    <p><strong>Turma: </strong><span id="nomeTurma"></span></p>
                    <p><strong>Disciplina: </strong><span id="nomeDisciplinaElement"></span></p>
                    <p><strong>Descrição da aula: </strong><span id="descricaoId"></span></p>

                    <!-- Tabela de ingredientes -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Ingrediente</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Unidade</th>
                            </tr>
                        </thead>
                        <tbody id="ingredientesTableBody">
                            <!-- Os ingredientes serão inseridos aqui via JS -->
                        </tbody>
                    </table>
                    <div>
                        <form action="<?= BASEURL ?>/controller/RequisicoesController.php?action=gerenciarStatus" method="post">
                            <button type="submit" class="btn btn-success">Aprovar</button>
                            <input type="hidden" name="id" id="idReq" value="">
                            <input type="hidden" name="status" value="APROVADO">
                        </form>
                        <form action="<?= BASEURL ?>/controller/RequisicoesController.php?action=gerenciarStatus" method="post">
                            <textarea class="form-control mt-2 d-none" id="motivoRejeicao" name="motivo" placeholder="Informe o motivo da rejeição" required></textarea>
                            <button type="submit" class="btn btn-danger mt-2 d-none" id="btnSubmitRejeitar">Confirmar Rejeição</button>
                            <input type="hidden" name="id" id="idReqReject" value="">
                            <input type="hidden" name="status" value="REJEITADO">
                        </form>
                        <button type="button" class="btn btn-danger" id="btnRejeitar">Rejeitar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<input type="hidden" id="baseurl" value="<?= BASEURL ?>">

<script src="<?= BASEURL ?>/view/requisicao/gerenciar.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>