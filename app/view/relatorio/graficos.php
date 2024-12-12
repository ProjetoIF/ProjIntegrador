<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Gráficos</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row justify-content-center mb-4">

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-primary h-100">
                <div class="card-header">Quantidade de requisições em <?= date("m") . "/" . date("Y"); ?></div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["reqMes"] ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-info h-100">
                <div class="card-header">Quantidade de requisições em <?= date("Y"); ?></div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["reqAno"] ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-warning h-100">
                <div class="card-header">Quantidade de requisições atualmente em análise</div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["reqAnalise"] ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-danger h-100">
                <div class="card-header">Quantidade de requisições atualmente em alteração</div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["reqAlteracao"] ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start mb-4">
        <div class="col-12 col-md-10">

            <div class="bg-light p-4 rounded">
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <canvas id="chartTurma"></canvas>
                    </div>
                    <div class="col-12 col-md-6">
                        <canvas id="donut-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start">
        <div class="col-12 col-md-6">
            <div class="bg-light p-4 rounded">
                <canvas id="chartMes"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Importando o Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const barChartDadosMes = JSON.parse(<?php echo json_encode($dados["reqPorMes"]); ?>)
    const barChartDadosTurmas = JSON.parse(<?php echo json_encode($dados["reqPorTurma"]); ?>)
    const donutChartDadosIngredientes = JSON.parse(<?php echo json_encode($dados["reqPorIngrediente"]); ?>)
</script>

<script src="<?= BASEURL ?>/view/relatorio/graficos.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>