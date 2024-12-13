<?php
require_once (__DIR__ . "/../model/Ingrediente.php");
class IngredienteService
{
    public function validarDados(Ingrediente $ingrediente) {
        $erros = array();

        //Validar campos vazios
        if (! $ingrediente->getNome()) {
            array_push($erros, "O campo <b>Nome</b> é obrigatório.");
        }

        if (! $ingrediente->getUnidadeDeMedida()) {
            array_push($erros, "O campo <b>Unidade de Medida</b> é obrigatório.");
        }

        if (! $ingrediente->getDescricao()) {
            array_push($erros, "O campo <b>Descrição</b> é obrigatório.");
        }

        if (! $ingrediente->getCaminhoImagem()) {
            array_push($erros, "O campo <b>Imagem</b> é obrigatório.");
        }

        // Retornar array de erros, mesmo que vazio
        return $erros;
    }
}