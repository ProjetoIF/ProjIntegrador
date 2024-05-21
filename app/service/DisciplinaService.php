<?php

require_once(__DIR__ . "/../model/Disciplina.php");
class DisciplinaService
{
    public function validarDados(Disciplina $disciplina) {
        $erros = array();

        //Validar campos vazios
        if (! $disciplina->getNome()) {
            array_push($erros, "O campo [Nome] é obrigatório.");
        }

        if (! $disciplina->getCargaHoraria()) {
            array_push($erros, "O campo [Carga horária] é obrigatório.");
        }

        // Retornar array de erros, mesmo que vazio
        return $erros;
    }
}