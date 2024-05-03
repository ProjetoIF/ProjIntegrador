<?php
require_once (__DIR__ . "/../model/Ingrediente.php");
class IngredienteService
{
    public function validarDados(Ingrediente $ingrediente) {
        $erros = array();

        //Validar campos vazios
        if (! $ingrediente->getNome()) {
            array_push($erros, "O campo [Nome] é obrigatório.");
        }

        if (! $ingrediente->getUnidadeDeMedida()) {
            array_push($erros, "O campo [Unidade de Medida] é obrigatório.");
        }

        if (! $ingrediente->getDescricao()) {
            array_push($erros, "O campo [Descrição] é obrigatório.");
        }

        if (! $ingrediente->getCaminhoImagem()) {
            array_push($erros, "O campo [Caminho da imagem] é obrigatório.");
        }

        // Retornar array de erros, mesmo que vazio
        return $erros;
    }
}