<?php
#View para a home do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/home/home.css">

<?php
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Olá <?= $nome ?></h3>
</div>

<div class="container">
    <div class="row justify-content-center mb-4">

        <h1 class="text-center mb-4">Status de suas requisições</h1>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-success h-100">
                <div class="card-header">Aprovadas</div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["quantidadeAprovadas"] ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-danger h-100">
                <div class="card-header">Rejeitadas</div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["quantidadeRejeitadas"] ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-warning h-100">
                <div class="card-header">Em análise</div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["quantidadeEnviadas"] ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card text-bg-primary h-100">
                <div class="card-header">Não concluídas</div>
                <div class="card-body">
                    <h5 class="card-title">Quantidade: <?= $dados["quantidadePreenchimento"] ?></h5>
                </div>
            </div>
        </div>
        <hr class="mb-4">

        <h1 class="text-center mb-4">Suas próximas requisições</h1>

        <?php if (empty($dados["requisicoes"])) : ?>
            <h3>Você não tem nenhuma requisição próxima</h3>
        <?php else : ?>
            <div>
                <?php foreach ($dados["requisicoes"] as $req) : ?>
                    <?php
                    // Define a classe da cor com base no status da requisição
                    $statusClass = match ($req->getStatus()) {
                        "REJEITADO" => "bg-danger",
                        "ENVIADO", "CORRECAO" => "bg-warning",
                        "PREENCHIMENTO" => "bg-secondary",
                        "APROVADO" => "bg-success",
                        default => "bg-secondary",
                    };
                    ?>
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
                                    <p class="card-text <?= $statusClass ?> text-light text-center fw-bold"><?= $req->getStatus(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</div>

<input type="hidden" id="baseurl" value="<?= BASEURL ?>">
<script src="<?= BASEURL ?>/view/home/home.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>