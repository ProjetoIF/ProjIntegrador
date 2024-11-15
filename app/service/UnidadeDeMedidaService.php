<?php
require_once(__DIR__ . "/../model/UnidadeDeMedida.php");

class UnidadeDeMedidaService
{
    public function validarDados(UnidadeDeMedida $unidade) {
        $erros = array();

        // Validar campos obrigatórios
        if (!$unidade->getNome()) {
            array_push($erros, "O campo [Nome] é obrigatório.");
        }

        if (!$unidade->getSigla()) {
            array_push($erros, "O campo [Sigla] é obrigatório.");
        }

        // Retornar array de erros, mesmo que vazio
        return $erros;
    }
}