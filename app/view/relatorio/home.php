<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>
<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Relatórios</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="col">
        <div class="row">
            <div class="card p-2 me-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Requisição geral</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Gerar requisição geral</h6>
                    <p class="card-text">A requisição geral irá agrupar somente as requisições que foram aprovadas</p>
                    <a href="<?= BASEURL . '/controller/RelatorioController.php?action=reqGeral' ?>" class="btn btn-primary">Gerar!</a>
                </div>
            </div>
        
            <div class="card p-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Gráficos</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Acompanhar gráficos</h6>
                    <p class="card-text">Ver os gráficos de requisições de aulas</p>
                    <a href="<?= BASEURL . '/controller/RelatorioController.php?action=graficos' ?>" class="btn btn-primary">Visualizar!</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>