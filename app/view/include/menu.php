<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= HOME_PAGE ?>">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Usuários</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL . '/controller/DisciplinaController.php?action=list' ?>">Disciplinas</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL . '/controller/IngredienteController.php?action=list' ?>">Ingredientes</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL . '/controller/TurmaController.php?action=list' ?>">Turmas</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL . '/controller/RequisicoesController.php?action=list' ?>">Requisicoes</a></li>
                    </ul>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= LOGOUT_PAGE ?>">Sair</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <?= $nome ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="sidebar">
    <div class="user-info container d-flex">
        <img src="caminho_para_imagem_do_usuario" alt="User Image" class="user-image">
        <div class="col">
            <div class="row">
                <p class="text"><?= $nome ?></p>
            </div>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li><a href="#"><i class="fas fa-lock"></i>Criar requisição</a></li>
        <li><a href="<?= BASEURL . '/controller/RequisicoesController.php?action=list' ?>""><i class="fas fa-lock"></i>Requisições</a></li>
        <li><a href="#"> <i class="fas fa-lock"></i>Disciplinas</a></li>
        <li><a href="#"> <i class="fas fa-lock"></i>Turmas</a></li>
        <li><a href="#"> <i class="fas fa-lock"></i>Ingredientes</a></li>
        <li><a href="#"><i class="fas fa-lock"></i>Relatórios</a></li>
        <li><a href="#"><i class="fas fa-lock"></i>Adicionar usuários</a></li>
        <li><a href="<?= LOGOUT_PAGE ?>"><i class="fas fa-lock"></i>Sair</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>">Usuários</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/DisciplinaController.php?action=list' ?>">Disciplinas</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/IngredienteController.php?action=list' ?>">Ingredientes</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/TurmaController.php?action=list' ?>">Turmas</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL . '/controller/RequisicoesController.php?action=list' ?>">Requisicoes</a></li>
            </ul>
        </li>
    </ul>
</div>


