<?php
#Nome do arquivo: requsicao/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

// Suponho que os dados da requisição já estejam no array $dados.
?>

<div class="container">
    <div class="nav-pages">
        <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Informe os ingredientes</h3>
        <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
    </div>

    <div class="row">
        <!-- Coluna de ingredientes, ajustada para dispositivos móveis -->
        <div class="col-lg-9 col-md-8 col-sm-12 mb-3 listIngredients">
            <div class="row">
                <!-- Exemplo de cards de ingredientes -->
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card">
                        <img src="..." class="card-img-top img-fluid" alt="Imagem do ingrediente">
                        <div class="card-body">
                            <h5 class="card-title">Vinagre</h5>
                            <p class="card-text">Body text.</p>
                        </div>
                    </div>
                </div>
                <!-- Repetir os cards conforme necessário -->
            </div>
        </div>

        <!-- Barra lateral direita com os detalhes da requisição -->
        <div class="col-lg-3 col-md-4 col-sm-12 reqDetails">
            <h4>Sua requisição está sendo feita!</h4>
            <div class="info-block">
                <p><strong>Turma selecionada:</strong><br><?= $dados['requisicao']->getIdTurma() ?></p>
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
                    <!-- Exemplo estático dos ingredientes, substitua pelo seu array dinâmico de ingredientes -->
                    <li><span>Batata</span><span>1Kg</span></li>
                    <li><span>Tomate</span><span>500g</span></li>
                    <li><span>Macarrão</span><span>1Kg</span></li>
                    <li><span>Arroz</span><span>2Kg</span></li>
                </ul>
            </div>

            <!-- Botões de ação -->
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
