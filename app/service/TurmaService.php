<?php
    
require_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class TurmaService {

    private DisciplinaDAO $disciplinaDAO;
    private UsuarioDAO $usuarioDAO;
    private TurmaDAO $turmaDAO;

    /* Método para validar os dados da turma que vem do formulário */
    public function validarDados(Turma $turma) {
        $erros = array();

        //Validar campos vazios
        if(! $turma->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if(! $turma->getAnoDeInicio())
            array_push($erros, "O campo [Ano de Início] é obrigatório.");

        if(! $turma->getSemestre())
            array_push($erros, "O campo [Semestre] é obrigatório.");

        if(! $turma->getIdProfessor())
            array_push($erros, "O campo [Professor] é obrigatório.");

        if(! $turma->getIdDisciplina())
            array_push($erros, "O campo [Disciplina] é obrigatório.");

        return $erros;
    }

    public function listTurma() {

        $this->disciplinaDAO = new DisciplinaDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->turmaDAO = new TurmaDAO();

        $turmas = $this->turmaDAO->list();

        foreach ($turmas as $turma) {
            $turma->setDisciplina($this->disciplinaDAO->findById($turma->getIdDisciplina()));
            $turma->setProfessor($this->usuarioDAO->findById($turma->getIdProfessor()));
        }


        return $turmas;
    }

}
