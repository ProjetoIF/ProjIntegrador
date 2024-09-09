<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

$nome = "(Sessão expirada)";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
?>
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
        <li><a href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a></li>
        <li><a href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>"><i class="fa-solid fa-users"></i>Usuários</a></li>
        <li><a href="<?= BASEURL . '/controller/RequisicoesController.php?action=list' ?>""><i class="fa-solid fa-clipboard-list"></i>Requisições</a></li>
        <li><a href="<?= BASEURL . '/controller/DisciplinaController.php?action=list' ?>"> <i class="fa-solid fa-book"></i>Disciplinas</a></li>
        <li><a href="<?= BASEURL . '/controller/TurmaController.php?action=list' ?>"> <i class="fa-solid fa-graduation-cap"></i></i>Turmas</a></li>
        <li><a href="<?= BASEURL . '/controller/IngredienteController.php?action=list' ?>"> <i class="fa-solid fa-utensils"></i>Ingredientes</a></li>
        <li><a href="#"><i class="fa-solid fa-chart-simple"></i>Relatórios</a></li>
        <li><a href="#"><i class="fa-solid fa-user-plus"></i>Adicionar usuários</a></li>
        <li><a href="<?= LOGOUT_PAGE ?>"><i class="fa-solid fa-right-from-bracket"></i>Sair</a></li>
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


