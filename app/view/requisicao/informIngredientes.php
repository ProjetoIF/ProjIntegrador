<?php
#Nome do arquivo: requsicao/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>
<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Informe os ingredientes</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 col-md-8 col-sm-12 offset-lg-2 mb-3 listIngredients">
            <div class="d-flex flex-wrap justify-content-start">
                <?php foreach ($dados['ingredientes'] as $ingrediente): ?>
                    <button class="ingrediente-btn m-2" style="border: none; background: transparent;"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-nome="<?= $ingrediente->getNome(); ?>"
                        data-unidade="<?= $ingrediente->getUnidadeDeMedida(); ?>"
                        data-descricao="<?= $ingrediente->getDescricao(); ?>"
                        data-imagem="<?= BASEURL_ING_IMG . $ingrediente->getCaminhoImagem(); ?>"
                        data-id-requisicao="<?= $dados['requisicao']->getId() ?>"
                        data-id-ingrediente="<?= $ingrediente->getId(); ?>">
                        <div class="card p-2" style="width: 200px;">
                            <img src="<?= BASEURL_ING_IMG . $ingrediente->getCaminhoImagem(); ?>" class="card-img-top img-fluid" alt="Imagem do ingrediente">
                            <div class="card-body">
                                <h5 class="card-title"><?= $ingrediente->getNome(); ?></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Uni. Medida: <?= $ingrediente->getUnidadeDeMedida(); ?></h6>
                                <p class="card-text"><?= $ingrediente->getDescricao(); ?></p>
                            </div>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-12 reqDetails">
            <h4>Sua requisição está sendo feita!</h4>
            <div class="info-block">
                <p><strong>Turma selecionada:</strong><br><?= $dados['turma']->getNome() ?></p>
            </div>
            <div class="info-block">
                <p><strong>Disciplina selecionada:</strong><br><?= $dados['disciplina']->getNome() ?></p>
            </div>
            <div class="info-block">
                <p><strong>Data escolhida:</strong><br><?= date("d/m/Y", strtotime($dados['requisicao']->getDataAula())) ?></p>
            </div>

            <div class="ingredients">
                <h4>Ingredientes selecionados:</h4>
                <ul class="ingredients-list">
                    <?php foreach ($dados['ingredientesSelecionados'] as $requisicaoIngrediente): ?>
                        <li>
                            <span><?= $requisicaoIngrediente->getIngrediente()->getNome(); ?></span>
                            <div>
                                <span style="margin-right: 0.8em;"><?= $requisicaoIngrediente->getQuantidade() . ' ' . $requisicaoIngrediente->getIngrediente()->getUnidadeDeMedida(); ?></span>
                                <span>
                                    <button class="btn btn-primary delete-ingredient" data-id="<?= $requisicaoIngrediente->getIdRequisicaoIngrediente(); ?>" data-id-requisicao="<?= $dados['requisicao']->getId() ?>">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <form action="" method="post">
                <div class="buttons mt-3">
                    <button class="btn btn-success">Enviar à coordenação</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="submit">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/view/requisicao/requisicao.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>