<?php

require_once(__DIR__ . "/../model/Requisicao.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/RequisicoesDAO.php");

class RequisicoesService
{
    private TurmaDAO $turmaDAO;
    private RequisicoesDAO $requisicaoDao;
    private Requisicao $requisicao;
    private DisciplinaDAO $disciplinaDAO;

    public function validarDados(Requisicao $requisicao)
    {
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

    public function listRequisicoes()
    {

        $this->requisicaoDao = new RequisicoesDAO();
        $this->turmaDAO = new TurmaDAO();

        $requisicoes = $this->requisicaoDao->list();

        foreach ($requisicoes as $req) {
            $req->setTurma($this->turmaDAO->findById($req->getIdTurma()));
        }


        return $requisicoes;
    }
}
