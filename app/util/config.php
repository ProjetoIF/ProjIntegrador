<?php
#Nome do arquivo: config.php
#Objetivo: define constantes para serem utilizadas no projeto



//Banco de dados: conexão MySQL
define('DB_HOST', 'localhost');
define('DB_NAME', 'projetoIntegrador');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

//Caminho para adionar imagens, scripts e chamar páginas no sistema
//Deve ter o nome da pasta do projeto no servidor APACHE
define('BASEURL', '/ProjIntegrador/app');
define('BASEURL_UPLOADS', '/ProjIntegrador/uploads/');

define('BASEURL_ING_IMG', '/ProjIntegrador/uploads/ingredientes/');

define('BASEURL_USER_IMG', '/ProjIntegrador/uploads/usuarios/');

//Nome do sistema
define('APP_NAME', 'Chef Track');

//Página de logout do sistema
define('LOGIN_PAGE', BASEURL . '/controller/LoginController.php?action=login');

//Página de login do sistema
define('LOGOUT_PAGE', BASEURL . '/controller/LoginController.php?action=logout');

//Página home do sistema
define('HOME_PAGE', BASEURL . '/controller/HomeController.php?action=home');

//Sessão do usuário
define('SESSAO_USUARIO_ID', "usuarioLogadoId");
define('SESSAO_USUARIO_NOME', "usuarioLogadoNome");
define('SESSAO_USUARIO_PAPEL', "usuarioLogadoPapel");
define('SESSAO_USUARIO_IMG', "usuarioLogadoImg");




