<?php
    
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, ?string $confSenha) {
        $erros = array();

        //Validar campos vazios
        if(! $usuario->getNome())
            array_push($erros, "O campo <b>Nome</b> é obrigatório.");

        if(! $usuario->getLogin())
            array_push($erros, "O campo <b>Login</b> é obrigatório.");

        if(! $usuario->getSenha())
            array_push($erros, "O campo <b>Senha</b> é obrigatório.");

        if(! $confSenha)
            array_push($erros, "O campo <b>Confirmação da senha</b> é obrigatório.");

        if(! $usuario->getPapel()) 
            array_push($erros, "O campo <b>Papel</b> é obrigatório");

        if(! $usuario->getCaminhoImagem()) 
            array_push($erros, "O campo <b>Imagem</b> é obrigatório");


        //Validar se a senha é igual a contra senha
        if($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo <b>Senha</b> deve ser igual ao <b>Confirmação da senha</b>.");

        return $erros;
    }

}
