<?php
#Nome do arquivo: TurmaDAO.php
#Objetivo: classe DAO para o model de Turma

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Turma.php");

class TurmaDAO {

    //Método para listar as turmas a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM turmas ORDER BY nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapTurmas($result);
    }

    //Método para buscar uma turma por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM turmas WHERE id = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $turmas = $this->mapTurmas($result);

        if(count($turmas) == 1)
            return $turmas[0];
        elseif(count($turmas) == 0)
            return null;

        die("TurmaDAO.findById()" . 
            " - Erro: mais de uma turma encontrada.");
    }

    //Método para inserir uma turma
    public function insert(Turma $turma) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO turmas (nome, data_inicio, semestre)" .
               " VALUES (:nome, :dataInicio, :semestre)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $turma->getNome());
        $stm->bindValue("dataInicio", $turma->getAnoDeInicio());
        $stm->bindValue("semestre", $turma->getSemestre());
        $stm->execute();
    }

    //Método para atualizar uma turma
    public function update(Turma $turma) {
        $conn = Connection::getConn();

        $sql = "UPDATE turmas SET nome = :nome, data_inicio = :dataInicio," .
               " semestre = :semestre WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $turma->getNome());
        $stm->bindValue("dataInicio", $turma->getAnoDeInicio());
        $stm->bindValue("semestre", $turma->getSemestre());
        $stm->bindValue("id", $turma->getId());
        $stm->execute();
    }

    //Método para excluir uma turma pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM turmas WHERE id = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    //Método para converter um registro da base de dados em um objeto Turma
    private function mapTurmas($result) {
        $turmas = array();
        foreach ($result as $reg) {
            $turma = new Turma();
            $turma->setId($reg['idTurma']);
            $turma->setNome($reg['nome']);
            $turma->setAnoDeInicio($reg['anoInicio']);
            $turma->setSemestre($reg['semestre']);
            array_push($turmas, $turma);
        }

        return $turmas;
    }

}
