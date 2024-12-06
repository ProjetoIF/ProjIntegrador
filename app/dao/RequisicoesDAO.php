<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Requisicao.php");
require_once(__DIR__ . "/../model/enum/RequisicaoStatus.php");
include_once(__DIR__ . "/../model/Turma.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class RequisicoesDAO
{

    private function mapRequisicoes($result)
    {
        $requisicoes = array();
        foreach ($result as $reg) {
            $requisicao = new Requisicao();
            $requisicao->setId($reg['idRequisicao']);
            $requisicao->setDescricao($reg['descricao']);
            $requisicao->setDataAula($reg['dataAula']);
            $requisicao->setStatus($reg['statusRequisicao']);
            $requisicao->setIdTurma($reg['idTurma']);
            $requisicao->setMotivoDevolucao($reg['motivoDevolucao']);

            if (isset($reg['nome'])) { //Mapeia os dados da turma
                $turma = new Turma();

                $disciplinaDAO = new DisciplinaDAO();
                $usuarioDAO = new UsuarioDAO();

                $turma->setId($reg['idTurma']);
                $turma->setNome($reg['nome']);
                $turma->setDisciplina($disciplinaDAO->findById($reg['idDisciplina']));
                $turma->setProfessor($usuarioDAO->findById($reg['idProfessor']));

                $requisicao->setTurma($turma);
            }
            array_push($requisicoes, $requisicao);
        }

        return $requisicoes;
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes r ORDER BY r.dataAula";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapRequisicoes($result);
    }

    public function insert(Requisicao $requisicao)
    {
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

    public function deleteById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM requisicoes WHERE idRequisicao = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes r" .
            " WHERE r.idRequisicao = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        if (count($requisicoes) == 1)
            return $requisicoes[0];
        elseif (count($requisicoes) == 0)
            return null;

        die("RequisicoesDAO.findById()" .
            " - Erro: mais de uma requisicao encontrado.");
    }

    public function update(Requisicao $requisicao)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE requisicoes SET descricao = :descricao, dataAula = :dataAula, " .
            "idTurma = :idTurma " .
            "WHERE idRequisicao = :id";


        $stm = $conn->prepare($sql);
        $stm->bindValue("descricao", $requisicao->getDescricao());
        $stm->bindValue("dataAula", $requisicao->getDataAula());
        $stm->bindValue("idTurma", $requisicao->getIdTurma());
        $stm->bindValue("id", $requisicao->getId());
        $stm->execute();
    }

    public function returnReqByTurma(int $turmaId)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes WHERE idTurma = :id";

        $stm = $conn->prepare($sql);

        $stm->bindValue("id", $turmaId);

        $stm->execute();

        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;
    }

    public function listByUsuario(int $idUsuario)
    {

        $conn = Connection::getConn();

        $sql = "SELECT r.*, t.* " .
            "FROM requisicoes r " .
            "JOIN turmas t ON (t.idTurma = r.idTurma) " .
            "WHERE t.idProfessor = :id";

        $stm = $conn->prepare($sql);

        $stm->bindValue("id", $idUsuario);

        $stm->execute();

        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;
    }

    public function updateReqStatus(int $idReq, string $status)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE requisicoes SET statusRequisicao = :statusReq WHERE idRequisicao = :id ";


        $stm = $conn->prepare($sql);
        $stm->bindValue("statusReq", $status);
        $stm->bindValue("id", $idReq);
        $stm->execute();
    }

    public function findByStatus(string $status)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoes WHERE statusRequisicao = :statusReq ";


        $stm = $conn->prepare($sql);
        $stm->bindValue("statusReq", $status);
        $stm->execute();

        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;
    }
    public function listByStatus(string $status)
    {

        $conn = Connection::getConn();

        $sql = "SELECT r.*, t.* " .
            "FROM requisicoes r " .
            "JOIN turmas t ON (t.idTurma = r.idTurma) " .
            "WHERE r.statusRequisicao = :status";

        $stm = $conn->prepare($sql);

        $stm->bindValue("status", $status);

        $stm->execute();

        $result = $stm->fetchAll();

        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;
    }
    public function updateMotivoDevolucao(int $idReq, string $motivo)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE requisicoes SET motivoDevolucao = :motivo WHERE idRequisicao = :id ";


        $stm = $conn->prepare($sql);
        $stm->bindValue("motivo", $motivo);
        $stm->bindValue("id", $idReq);
        $stm->execute();
    }

    public function findByDateRange(string $startDate, string $endDate, string $status)
    {
        $conn = Connection::getConn();

        // SQL com filtro de datas e status
        $sql = "SELECT * FROM requisicoes 
            WHERE dataAula BETWEEN :startDate AND :endDate 
            AND statusRequisicao = :statusReq";

        // Preparar e executar a consulta
        $stm = $conn->prepare($sql);
        $stm->bindValue("startDate", $startDate);
        $stm->bindValue("endDate", $endDate);
        $stm->bindValue("statusReq", $status);
        $stm->execute();

        // Buscar resultados
        $result = $stm->fetchAll();

        // Mapear os resultados para objetos ou array
        $requisicoes = $this->mapRequisicoes($result);

        return $requisicoes;
    }

    public function countByDateRange(string $startDate, string $endDate, string $status)
    {
        $conn = Connection::getConn();

        // SQL com filtro de datas e status
        $sql = "SELECT COUNT(*) FROM requisicoes 
            WHERE dataAula BETWEEN :startDate AND :endDate 
            AND statusRequisicao = :statusReq";

        // Preparar e executar a consulta
        $stm = $conn->prepare($sql);
        $stm->bindValue("startDate", $startDate);
        $stm->bindValue("endDate", $endDate);
        $stm->bindValue("statusReq", $status);
        $stm->execute();

        // Retornar o valor da contagem
        return $stm->fetchColumn(); // Captura a contagem diretamente
    }
}
