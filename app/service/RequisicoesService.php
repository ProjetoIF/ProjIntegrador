<?php

require_once(__DIR__ . "/../model/Requisicao.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/RequisicoesDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class RequisicoesService
{
    private TurmaDAO $turmaDAO;
    private RequisicoesDAO $requisicaoDao;
    private Requisicao $requisicao;
    private DisciplinaDAO $disciplinaDAO;
    private UsuarioDAO $usuarioDAO;

    public function validarDados(Requisicao $requisicao)
    {
        $erros = array();

        //Validar campos vazios
        if (! $requisicao->getDescricao()) {
            array_push($erros, "O campo <b>Descrição</b> é obrigatório.");
        }

        if (! $requisicao->getDataAula()) {
            array_push($erros, "O campo <b>Data da aula</b> é obrigatório.");
        }

        if (! $requisicao->getIdTurma()) {
            array_push($erros, "O campo <b>Turma</b> é obrigatório.");
        }

        // Retornar array de erros, mesmo que vazio
        return $erros;
    }

    public function listRequisicoes()
    {

        $this->requisicaoDao = new RequisicoesDAO();
        $this->turmaDAO = new TurmaDAO();

        $requisicoes = $this->requisicaoDao->list();

        foreach ($requisicoes as $req) {

            $this->usuarioDAO = new UsuarioDAO();

            $req->setTurma($this->turmaDAO->findById($req->getIdTurma()));
            //Busca o professor referente a sua turma
            $req->getTurma()->setProfessor($this->usuarioDAO->findById($req->getTurma()->getIdProfessor()));
        }


        return $requisicoes;
    }
}
