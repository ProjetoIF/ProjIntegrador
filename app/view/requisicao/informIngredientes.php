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
                <?php foreach($dados['ingredientes'] as $ingrediente): ?>
                    <button class="ingrediente-btn m-2" style="border: none; background: transparent;">
                        <div class="card p-2" style="width: 200px;">
                            <img src="<?= $ingrediente->getCaminhoImagem(); ?>" class="card-img-top img-fluid" alt="Imagem do ingrediente">
                            <div class="card-body">
                                <h5 class="card-title"><?= $ingrediente->getNome();?></h5>
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
                <p><strong>Disciplina selecionada:</strong><br><?= $dados['requisicao']->getDescricao() ?></p>
            </div>
            <div class="info-block">
                <p><strong>Data escolhida:</strong><br><?= date("d/m/Y", strtotime($dados['requisicao']->getDataAula())) ?></p>
            </div>

            <div class="ingredients">
                <h4>Ingredientes selecionados:</h4>
                <ul class="ingredients-list">
                    <li><span>Batata</span><span>1Kg</span></li>
                    <li><span>Tomate</span><span>500g</span></li>
                    <li><span>Macarrão</span><span>1Kg</span></li>
                    <li><span>Arroz</span><span>2Kg</span></li>
                </ul>
            </div>

            <div class="buttons">
                <button class="btn btn-secondary mb-2">Editar</button>
                <button class="btn btn-success">Finalizar</button>
            </div>
        </div>
    </div>
</div>



<?php
require_once(__DIR__ . "/../include/footer.php");
?>