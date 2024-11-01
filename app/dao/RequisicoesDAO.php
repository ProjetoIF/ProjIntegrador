<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Requisicao.php");
require_once (__DIR__ . "/../model/enum/RequisicaoStatus.php");
include_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");

class RequisicoesDAO
{

    private function mapRequisicoes($result) {
        $requisicoes = array();
        foreach ($result as $reg) {
            $requisicao = new Requisicao();
            $requisicao->setId($reg['idRequisicao']);
            $requisicao->setDescricao($reg['descricao']);
            $requisicao->setDataAula($reg['dataAula']);
            $requisicao->setStatus($reg['statusRequisicao']);
            $requisicao->setIdTurma($reg['idTurma']);
            $requisicao->setMotivoDevolucao($reg['motivoDevolucao']);

            if(isset($reg['nome'])) { //Mapeia os dados da turma
                $turma = new Turma();

                $disciplinaDAO = new DisciplinaDAO();
                
                $turma->setId($reg['idTurma']);
                $turma->setNome($reg['nome']);
                $turma->setDisciplina($disciplinaDAO->findById($reg['idDisciplina']));

                $requisicao->setTurma($turma);
            }
            array_push($requisicoes, $requisicao);
        }

        return $requisicoes;
    }

    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes r ORDER BY r.dataAula";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapRequisicoes($result);
    }

    public function insert(Requisicao $requisicao) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO requisicoes (descricao, dataAula, statusRequisicao, idTurma)" .
            " VALUES (:descricao, :dataAula, :status, :idTurma)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("descricao", $requisicao->getDescricao());
        $stm->bindValue("dataAula", $requisicao->getDataAula());
        $stm->bindValue("status", RequisicaoStatus::PREENCHIMENTO);
        $stm->bindValue("idTurma", $requisicao->getIdTurma());
        $stm->execute();
    }

    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM requisicoes WHERE idRequisicao = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes r" .
            " WHERE r.idRequisicao = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        if(count($requisicoes) == 1)
            return $requisicoes[0];
        elseif(count($requisicoes) == 0)
            return null;

        die("RequisicoesDAO.findById()" .
            " - Erro: mais de uma requisicao encontrado.");
    }

    public function update(Requisicao $requisicao) {
        $conn = Connection::getConn();

        $sql = "UPDATE requisicoes SET descricao = :descricao, dataAula = :dataAula, ".
            "statusRequisicao = :status, idTurma = :idTurma, motivoDevolucao = :motivoDevolucao ".
            "WHERE idRequisicao = :id";


        $stm = $conn->prepare($sql);
        $stm->bindValue("descricao", $requisicao->getDescricao());
        $stm->bindValue("dataAula", $requisicao->getDataAula());
        $stm->bindValue("status", $requisicao->getStatus());
        $stm->bindValue("idTurma", $requisicao->getIdTurma());
        $stm->bindValue("motivoDevolucao", $requisicao->getMotivoDevolucao());
        $stm->bindValue("id", $requisicao->getId());
        $stm->execute();
    }

    public function returnReqByTurma(int $turmaId){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes WHERE idTurma = :id";

        $stm = $conn->prepare($sql);

        $stm->bindValue("id", $turmaId);

        $stm->execute();

        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;

    }

    public function listByUsuario(int $idUsuario) {

        $conn = Connection::getConn();

        $sql = "SELECT r.*, t.* ".
                "FROM requisicoes r ".
                "JOIN turmas t ON (t.idTurma = r.idTurma) ".
                "WHERE t.idProfessor = :id";
        
        $stm = $conn->prepare($sql);

        $stm->bindValue("id", $idUsuario);

        $stm->execute();

        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;

    }

}