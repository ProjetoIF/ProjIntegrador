<?php
    
require_once(__DIR__ . "/../model/Turma.php");

class TurmaService {

    /* Método para validar os dados da turma que vem do formulário */
    public function validarDados(Turma $turma) {
        $erros = array();

        //Validar campos vazios
        if(! $turma->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if(! $turma->getAnoDeInicio())
            array_push($erros, "O campo [Data de Início] é obrigatório.");

        if(! $turma->getSemestre())
            array_push($erros, "O campo [Semestre] é obrigatório.");

        return $erros;
    }

}
