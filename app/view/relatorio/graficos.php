<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Gráficos</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row">
        <div class="card text-bg-primary mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições em <?= date("m") . "/" . date("Y"); ?></div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade: <?= $dados["reqMes"] ?></h5>
            </div>
        </div>

        <div class="card text-bg-info mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições em <?= date("Y"); ?></div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade: <?= $dados["reqAno"] ?></h5>
            </div>
        </div>

        <div class="card text-bg-warning mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições atualmente em análise</div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade: <?= $dados["reqAnalise"] ?></h5>
            </div>
        </div>

        <div class="card text-bg-danger mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições atualmente em alteração</div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade: <?= $dados["reqAlteracao"] ?></h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <canvas id="chartTurma"></canvas>
        </div>
        <div class="col-5">
            <canvas id="donut-chart"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <canvas id="chartMes"></canvas>
        </div>
    </div>
</div>


<!-- Importando o Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const barChartDadosMes = JSON.parse(<?php echo json_encode($dados["reqPorMes"]); ?>)
    const barChartDadosTumas = JSON.parse(<?php echo json_encode($dados["reqPorTurma"]); ?>)
</script>

<script src="<?= BASEURL ?>/view/relatorio/graficos.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>