<?php
#Nome do arquivo: view/include/menu.php
#Objetivo: menu da aplicação para ser incluído em outras páginas

require_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");

$nome = "(Sessão expirada)";
$papel = "";
if(isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
    $papel = $_SESSION[SESSAO_USUARIO_PAPEL];
?>
<div class="sidebar" id="sidebar">
    <div class="user-info container d-flex">
        <img src="caminho_para_imagem_do_usuario" alt="User Image" class="user-image">
        <div class="col">
            <div class="row">
                <p class="text" id="userName"><?= $nome ?></p>
            </div>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li><a href="<?= BASEURL . '/controller/UsuarioController.php?action=list' ?>"><i class="fa-solid fa-users"></i>Usuários</a></li>
        <li><a href="<?= BASEURL . '/controller/RequisicoesController.php?action=list' ?>"><i class="fa-solid fa-clipboard-list"></i>Requisições</a></li>
        <li><a href="<?= BASEURL . '/controller/DisciplinaController.php?action=list' ?>"><i class="fa-solid fa-book"></i>Disciplinas</a></li>
        <li><a href="<?= BASEURL . '/controller/TurmaController.php?action=list' ?>"><i class="fa-solid fa-graduation-cap"></i>Turmas</a></li>
        <li><a href="<?= BASEURL . '/controller/IngredienteController.php?action=list' ?>"><i class="fa-solid fa-utensils"></i>Ingredientes</a></li>
        <li><a href="#"><i class="fa-solid fa-chart-simple"></i>Relatórios</a></li>
        <li><a href="<?= BASEURL ?>/controller/UsuarioController.php?action=create"><i class="fa-solid fa-user-plus"></i>Adicionar usuários</a></li>
        <li><a href="<?= LOGOUT_PAGE ?>"><i class="fa-solid fa-right-from-bracket"></i>Sair</a></li>
    </ul>
    <button class="close-btn" id="close-btn">&times;</button> <!-- Botão X -->
</div>

<!-- Botão sanduíche -->
<button class="open-btn" id="open-btn">&#9776;</button>

