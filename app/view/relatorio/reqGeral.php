<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>
<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Criar uma requisição geral</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <form action="" class="form-group row">
        <input type="hidden" name="action" value="reqGeral">
        <div class="col-12 col-md-6 d-flex align-items-center p-2">
            <h3 class="mb-0 mr-2 w-100">Data de inicio</h3>
            <input required type="date" name="inicio" class="form-control" value="<?= isset($_GET['inicio']) ? htmlspecialchars($_GET['inicio']) : '' ?>">
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center p-2">
            <h3 class="mb-0 mr-2 w-100">Data de fim</h3>
            <input required type="date" name="fim" class="form-control" value="<?= isset($_GET['fim']) ? htmlspecialchars($_GET['fim']) : '' ?>">
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <?php if (isset($dados["count"])) : ?>
                <?php if ($dados["count"] > 0) : ?>
                    <h4 class="mt-5 mb-0">Total de requisições: <?= $dados["count"] ?> </h4>
                    <a id="print" class="btn-padrao btn"><i class="fa-solid fa-print"></i> Imprimir</a>
                <?php else : ?>
                    <h4 class="mt-5 mb-0">Nenhuma requisição encontrada</h4>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (isset($dados["count"])) : ?>
                <?php
                //print_r($dados["requisicoes"]); 
                ?>
            <?php endif ?>
        </div>
    </div>
    <?php if (isset($dados["reqIn"])): ?>
        <div class="row">
            <div class="col">
                <?php
                // Array para armazenar a soma dos ingredientes
                $somaIngredientes = [];

                foreach ($dados["reqIn"] as $reqIn): ?>
                    <table class="table table-striped" border="1">
                        <thead>
                            <tr>
                                <th colspan="4">Requisição ID: <?php echo $reqIn[0]->getIdRequisicao(); ?></th>
                            </tr>
                            <tr>
                                <th>ID Ingrediente</th>
                                <th>Nome</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reqIn as $req):
                                $ingrediente = $req->getIngrediente();
                                $quantidade = $req->getQuantidade();
                                $unidade = $ingrediente->getUnidadeDeMedida();

                                // Identificador único para o ingrediente (ID + Unidade)
                                $key = $ingrediente->getId() . "_" . $unidade->getId();

                                // Soma dos ingredientes
                                if (!isset($somaIngredientes[$key])) {
                                    $somaIngredientes[$key] = [
                                        'id' => $ingrediente->getId(),
                                        'nome' => $ingrediente->getNome(),
                                        'quantidade' => 0,
                                        'unidade' => $unidade->getNome() . " (" . $unidade->getSigla() . ")",
                                    ];
                                }
                                $somaIngredientes[$key]['quantidade'] += $quantidade;
                            ?>
                                <tr>
                                    <td><?php echo $ingrediente->getId(); ?></td>
                                    <td><?php echo $ingrediente->getNome(); ?></td>
                                    <td><?php echo $quantidade . " " . $unidade->getNome() . " (" . $unidade->getSigla() . ")"; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tabela com a soma dos ingredientes -->
        <div class="row">
            <div class="col">
                <h3>Requisição geral</h3>
                <table class="table table-striped" border="1">
                    <thead>
                        <tr>
                            <th>ID Ingrediente</th>
                            <th>Nome</th>
                            <th>Quantidade Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($somaIngredientes as $ingrediente): ?>
                            <tr>
                                <td><?php echo $ingrediente['id']; ?></td>
                                <td><?php echo $ingrediente['nome']; ?></td>
                                <td><?php echo $ingrediente['quantidade'] . " " . $ingrediente['unidade']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
</div>

<script src="<?= BASEURL ?>/view/relatorio/reqGeral.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>