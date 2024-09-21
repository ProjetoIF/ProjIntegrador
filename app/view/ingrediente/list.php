<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Ingredientes</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn-padrao btn"
                href="<?= BASEURL ?>/controller/IngredienteController.php?action=create">
                <i class="fa-solid fa-plus"></i> Inserir</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <!-- Adiciona a classe table-responsive para tornar a tabela responsiva -->
            <div class="table-responsive">
                <table id="tabIngredientes" class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade de medida</th>
                        <th>Descrição</th>
                        <th>Imagem</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dados['lista'] as $ingrediente): ?>
                        <tr>
                            <td><?php echo $ingrediente->getId(); ?></td>
                            <td><?= $ingrediente->getNome(); ?></td>
                            <td><?= $ingrediente->getUnidadeDeMedida(); ?></td>
                            <td><?= $ingrediente->getDescricao(); ?></td>
                            <td><img src="<?= $ingrediente->getCaminhoImagem(); ?>" alt="<?= $ingrediente->getNome(); ?>" style="max-width: 100px;"></td>
                            <td><a class="btn btn-primary"
                                   href="<?= BASEURL ?>/controller/IngredienteController.php?action=edit&id=<?= $ingrediente->getId() ?>">
                                    Alterar</a>
                            </td>
                            <td><a class="btn btn-danger"
                                   onclick="return confirm('Confirma a exclusão do usuário?');"
                                   href="<?= BASEURL ?>/controller/IngredienteController.php?action=delete&id=<?= $ingrediente->getId() ?>">
                                    Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div> <!-- Fim da div table-responsive -->
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
