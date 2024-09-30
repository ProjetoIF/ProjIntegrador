<?php

require_once(__DIR__ . "/../model/Requisicao.php");
class RequisicoesService
{
    public function validarDados(Requisicao $requisicao) {
        $erros = array();

        //Validar campos vazios
        if (! $requisicao->getDescricao()) {
            array_push($erros, "O campo [Descrição] é obrigatório.");
        }

        if (! $requisicao->getDataAula()) {
            array_push($erros, "O campo [Data da aula] é obrigatório.");
        }

        if (! $requisicao->getIdTurma()) {
            array_push($erros, "O campo [Turma] é obrigatório.");
        }

        // Retornar array de erros, mesmo que vazio
        return $erros;
    }
}