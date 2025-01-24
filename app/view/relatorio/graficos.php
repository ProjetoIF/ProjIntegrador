<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>

<div class="nav-pages text-center mb-4">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Gráficos</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i> Home</a>
</div>

<div class="container">

    <!-- Filtro de Ano -->
    <div class="filter-section bg-light p-3 rounded mb-4">
        <form action="" class="d-flex align-items-center">
            <input type="hidden" name="action" value="graficos">
            <label for="selAno" class="me-2"><i class="fa-solid fa-calendar-days"></i> Selecione o ano:</label>
            <select class="form-control me-2" id="selAno" name="ano" required>
                <option value="">--Selecione o ano--</option>
                <?php foreach ($dados["anosDeRequisicao"] as $ano): ?>
                    <option value="<?= $ano ?>" <?= isset($_GET['ano']) && $_GET['ano'] == $ano ? 'selected' : '' ?>>
                        <?= $ano ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Filtrar</button>
        </form>
    </div>

    <!-- Indicadores -->
    <div class="row justify-content-center mb-4">
        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card h-100 text-bg-primary">
                <div class="card-header">Requisições em <?= date("m") . "/" . date("Y"); ?></div>
                <div class="card-body text-center">
                    <i class="fa-solid fa-chart-line fa-2x mb-2"></i>
                    <h5 class="card-title">Quantidade: <?= $dados["reqMes"] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card h-100 text-bg-info">
                <div class="card-header">Requisições em <?= isset($_GET['ano']) ? $_GET['ano'] : date("Y"); ?></div>
                <div class="card-body text-center">
                    <i class="fa-solid fa-calendar-alt fa-2x mb-2"></i>
                    <h5 class="card-title">Quantidade: <?= $dados["reqAno"] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card h-100 text-bg-warning">
                <div class="card-header">Requisições em análise</div>
                <div class="card-body text-center">
                    <i class="fa-solid fa-spinner fa-2x mb-2"></i>
                    <h5 class="card-title">Quantidade: <?= $dados["reqAnalise"] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card h-100 text-bg-danger">
                <div class="card-header">Requisições em alteração</div>
                <div class="card-body text-center">
                    <i class="fa-solid fa-edit fa-2x mb-2"></i>
                    <h5 class="card-title">Quantidade: <?= $dados["reqAlteracao"] ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row justify-content-start mb-4">
        <div class="col-12 col-md-10">
            <div class="bg-light p-4 rounded">
                <h5 class="mb-3">Distribuição de Requisições</h5>
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
                <h5 class="mb-3">Requisições Mensais</h5>
                <canvas id="chartMes"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- Importando o Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const barChartDadosMes = JSON.parse(<?php echo json_encode($dados["reqPorMes"]); ?>);
    const barChartDadosTurmas = JSON.parse(<?php echo json_encode($dados["reqPorTurma"]); ?>);
    const donutChartDadosIngredientes = JSON.parse(<?php echo json_encode($dados["reqPorIngrediente"]); ?>);
</script>

<script src="<?= BASEURL ?>/view/relatorio/graficos.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>