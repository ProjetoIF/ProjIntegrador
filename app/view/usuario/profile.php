<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

$usuario = $dados["usuario"];
?>

<link rel="stylesheet" href="<?= BASEURL . '/assets/static/profile.css' ?>">

<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Meu perfil</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container mt-5">
    <div class="row">
        <!-- Coluna da esquerda - Foto e Nome -->
        <div class="col-md-4">
            <div class="bg-primary text-white p-4 text-center rounded position-relative">
                <!-- Imagem de Perfil com Efeito Hover -->
                <?php if (!empty($usuario->getCaminhoImagem())): ?>
                    <img src="<?= BASEURL_USER_IMG . $usuario->getCaminhoImagem() ?>" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3 perfil-imagem" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid white;">
                <?php else: ?>
                    <img src="/uploads/usuarios/userDefault.jpeg" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3 perfil-imagem" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid white;">
                <?php endif; ?>

                <!-- Ícone de Edição -->
                <div class="editar-icon">
                    <i class="fa-regular fa-pen-to-square"></i>
                </div>

                <!-- Nome e Papel do Usuário -->
                <h3 class="font-weight-bold mt-3"><?= htmlspecialchars($usuario->getNome()) ?></h3>
                <p><strong>Papel:</strong> <?= htmlspecialchars($usuario->getPapel()) ?></p>
            </div>
        </div>

        <!-- Coluna da direita - Informações do Usuário -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fa-regular fa-pen-to-square"></i> Editar Perfil</h5>
                </div>
                <div class="card-body">
                    <!-- Exibir dados do usuário -->
                    <div class="mb-3">
                        <strong>Login:</strong>
                        <span id="login"><?= htmlspecialchars($usuario->getLogin()) ?></span>
                        <button class="btn btn-warning btn-sm ml-2" onclick="editarCampo('login')">Alterar</button>
                    </div>

                    <div class="mb-3">
                        <strong>E-mail:</strong>
                        <span id="email"><?= htmlspecialchars($usuario->getEmail()) ?></span>
                        <button class="btn btn-warning btn-sm ml-2" onclick="editarCampo('email')">Alterar</button>
                    </div>

                    <div class="mb-3">
                        <strong>Telefone:</strong>
                        <span id="telefone"><?= htmlspecialchars($usuario->getTelefone()) ?></span>
                        <button class="btn btn-warning btn-sm ml-2" onclick="editarCampo('telefone')">Alterar</button>
                    </div>

                    <!-- Seção para Alterar Senha -->
                    <div class="mb-3" id="senha-div">
                        <strong>Senha:</strong>
                        <span id="senha">**********</span>
                        <button class="btn btn-warning btn-sm ml-2" onclick="editarSenha()">Alterar</button>
                    </div>

                    <!-- Campos de edição de senha -->
                    <div class="mb-3" id="nova-senha-div" style="display: none;">
                        <label for="nova-senha">Nova Senha:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="nova-senha" placeholder="Digite a nova senha">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-nova-senha" onclick="toggleSenha('nova-senha')">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="confirmar-senha-div" style="display: none;">
                        <label for="confirmar-senha">Confirmar Senha:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmar-senha" placeholder="Confirme a nova senha">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-confirmar-senha" onclick="toggleSenha('confirmar-senha')">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button id="salvar-senha-btn" class="btn btn-primary btn-sm" style="display: none;" onclick="salvarSenha()">Salvar Senha</button>
                    
                    <!-- Campo escondido para o userId -->
                    <input type="hidden" id="userId" value="<?= $usuario->getId() ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL ?>/view/usuario/profile.js"></script>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
