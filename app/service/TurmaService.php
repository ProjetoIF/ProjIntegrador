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
            array_push($erros, "O campo <b>Nome</b> é obrigatório.");

        if(! $turma->getAnoDeInicio())
            array_push($erros, "O campo <b>Ano de Início</b> é obrigatório.");

        if(! $turma->getSemestre())
            array_push($erros, "O campo <b>Semestre</b> é obrigatório.");

        if(! $turma->getIdProfessor())
            array_push($erros, "O campo <b>Professor</b> é obrigatório.");

        if(! $turma->getIdDisciplina())
            array_push($erros, "O campo <b>Disciplina</b> é obrigatório.");

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
