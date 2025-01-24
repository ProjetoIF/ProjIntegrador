<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class UsuarioService
{
    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }
    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, ?string $confSenha, ?bool $alterarSenha)
    {
        $erros = array();

        //Validar campos vazios
        if (! $usuario->getNome())
            array_push($erros, "O campo <b>Nome</b> é obrigatório.");

        if (! $usuario->getLogin()){
            array_push($erros, "O campo <b>Login</b> é obrigatório.");
        }
        // else{
        //     if ($this->usuarioDao->verifyLoginUsage($usuario->getLogin())) {
        //         array_push($erros, "O login <b>" . $usuario->getLogin() . "</b> já está em uso!");
        //     }
        // }

        if ($alterarSenha) {
            if (! $usuario->getSenha())
                array_push($erros, "O campo <b>Senha</b> é obrigatório.");

            if (! $confSenha)
                array_push($erros, "O campo <b>Confirmação da senha</b> é obrigatório.");
        }

        if (! $usuario->getPapel())
            array_push($erros, "O campo <b>Papel</b> é obrigatório");

        if (! $usuario->getTelefone())
            array_push($erros, "O campo <b>Telefone</b> é obrigatório");

        if (! $usuario->getEmail())
            array_push($erros, "O campo <b>Email</b> é obrigatório");

        //  if(! $usuario->getCaminhoImagem()) 
        //      array_push($erros, "O campo <b>Imagem</b> é obrigatório");


        //Validar se a senha é igual a contra senha
        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo <b>Senha</b> deve ser igual ao <b>Confirmação da senha</b>.");

        return $erros;
    }
}
