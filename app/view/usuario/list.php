<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<div class="nav-pages">
    <h3 class="font-weight-bold poppins-extrabold">Usuários</h3>
    <a class="btn" href="#">Home</a> <!-- Ajuste o href conforme necessário -->
</div>


<div class="container">
        <div class="row">
            <div class="col-3">
                <a class="btn btn-success"
                    href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">
                    Inserir</a>
            </div>

            <div class="col-9">
                <?php require_once(__DIR__ . "/../include/msg.php"); ?>
            </div>
        </div>

        <div class="row" style="margin-top: 10px;">
            <div class="col-12">
                <table id="tabUsuarios" class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Papel</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados['lista'] as $usu): ?>
                            <tr>
                                <td><?php echo $usu->getId(); ?></td>
                                <td><?= $usu->getNome(); ?></td>
                                <td><?= $usu->getLogin(); ?></td>
                                <td><?= $usu->getPapel(); ?></td>
                                <td><?= $usu->getTelefone(); ?></td>
                                <td><?= $usu->getEmail(); ?></td>
                                <td><?= $usu->isActive(); ?></td>
                                <td><a class="btn btn-primary"
                                    href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>">
                                        <i class="fa-regular fa-pen-to-square"></i> Alterar</a>
                                </td>
                                <td><a class="btn btn-danger"
                                    onclick="return confirm('Confirma a exclusão do usuário?');"
                                    href="<?= BASEURL ?>/controller/UsuarioController.php?action=delete&id=<?= $usu->getId() ?>">
                                        <i class="fa-solid fa-trash-can"></i> Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
