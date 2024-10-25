<?php
# Nome do arquivo: requisicao/list.php
# Objetivo: interface para listagem das requisições do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>
<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Minhas requisições</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <?php if (empty($dados["requisicoes"])) : ?>
        <h3>Você ainda não fez nenhuma requisição</h3>
    <?php else : ?>
        <div class="row">
            <h3>Minhas requiquisições não concluídas</h3>
            <?php foreach ($dados["requisicoes"] as $req) :
                if ($req->getStatus() === $dados["status"][0]) :
                    // Pegando a turma correspondente pelo ID
                    $turma = isset($dados["turmas"][$req->getIdTurma()]) ? $dados["turmas"][$req->getIdTurma()] : null;
            ?>
                    <div class="card m-3" style="max-width: 27.5em;">
                        <div class="row g-0">
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title">Disciplina</h5>
                                    <p class="card-text">
                                        <small class="text-body-secondary">
                                            <?= $turma ? $turma->getNome() : "Turma não encontrada"; ?>
                                        </small>
                                    </p>
                                    <p class="card-text"><?= $req->getDescricao() ?></p>
                                </div>
                            </div>
                            <div class="col-md-5 border-start" style="border-color: #d3d3d3;">
                                <div class="p-3">
                                    <p class="card-text"><?= $req->getDataAula() ?></p>
                                    <p class="card-text"><?= $req->getStatus() ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>


        <div class="row mt-5">
            <h3>Minhas requiquisições recusadas</h3>
            <?php foreach ($dados["requisicoes"] as $req) :
                if ($req->getStatus() === "REJEITADO") : ?>
                    <p><?= print_r($req, true); ?></p>
            <?php endif;
            endforeach; ?>
        </div>

        <div class="row mt-5">
            <h3>Minhas requiquisições em análise</h3>
            <?php foreach ($dados["requisicoes"] as $req) :
                if (in_array($req->getStatus(), ["ENVIADO", "CORRECAO"])) : ?>
                    <p><?= print_r($req, true); ?></p>
            <?php endif;
            endforeach; ?>
        </div>

        <div class="row mt-5">
            <h3>Minhas requiquisições concluídas</h3>
            <?php foreach ($dados["requisicoes"] as $req) :
                if ($req->getStatus() === "APROVADO") : ?>
                    <p><?= print_r($req, true); ?></p>
            <?php endif;
            endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>