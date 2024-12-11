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
            <div class="card-header">Quantidade de requisições em <?= date("m")."/".date("Y"); ?></div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade:  <?= $dados["reqMes"] ?></h5>
            </div>
        </div>
    
        <div class="card text-bg-info mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições em <?= date("Y"); ?></div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade:  <?= $dados["reqAno"] ?></h5>
            </div>
        </div>

        <div class="card text-bg-warning mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições atualmente em análise</div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade:  <?= $dados["reqAnalise"] ?></h5>
            </div>
        </div>

        <div class="card text-bg-danger mb-3 m-2" style="max-width: 18rem;">
            <div class="card-header">Quantidade de requisições atualmente em alteração</div>
            <div class="card-body">
                <h5 class="card-title"> Quantidade:  <?= $dados["reqAlteracao"] ?></h5>
            </div>
        </div>
    </div>


    <canvas id="donut-chart" width="400" height="400"></canvas>
</div>

<!-- Importando o Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Configuração do gráfico do tipo 'doughnut' com Chart.js
    const ctx = document.getElementById('donut-chart').getContext('2d');
    const donutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Blue', 'Orange', 'Green'], // Rótulos das categorias
            datasets: [{
                data: [2, 4, 3], // Dados para o gráfico
                backgroundColor: [
                    'blue',
                    'orange',
                    'green'
                ],
                hoverOffset: 4 // Destaque ao passar o mouse
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Exemplo de Gráfico Donut'
                }
            }
        }
    });
</script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>