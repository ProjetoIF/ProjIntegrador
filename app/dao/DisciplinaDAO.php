<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Disciplina.php");
class DisciplinaDAO
{
    private function mapDisciplinas($result) {
        $disciplinas = array();
        foreach ($result as $reg) {
            $disciplina = new Disciplina();
            $disciplina->setId($reg['idDisciplina']);
            $disciplina->setNome($reg['nomeDisciplina']);
            $disciplina->setCargaHoraria($reg['cargaHoraria']);;
            array_push($disciplinas, $disciplina);
        }

        return $disciplinas;
    }

    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM disciplinas d ORDER BY d.nomeDisciplina";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapDisciplinas($result);
    }

    public function insert(Disciplina $disciplina) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO disciplinas (nomeDisciplina, cargaHoraria)" .
            " VALUES (:nome, :cargaHoraria)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $disciplina->getNome());
        $stm->bindValue("cargaHoraria", $disciplina->getCargaHoraria());
        $stm->execute();
    }

    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM disciplinas WHERE idDisciplina = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM disciplinas d" .
            " WHERE d.idDisciplina = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $disciplinas = $this->mapDisciplinas($result);

        if(count($disciplinas) == 1)
            return $disciplinas[0];
        elseif(count($disciplinas) == 0)
            return null;

        die("UsuarioDAO.findById()" .
            " - Erro: mais de uma disciplina encontrado.");
    }

    public function update(Disciplina $disciplina) {
        $conn = Connection::getConn();

        $sql = "UPDATE disciplinas SET nomeDisciplina = :nome, cargaHoraria = :cargaHoraria WHERE idDisciplina = :id";


        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $disciplina->getNome());
        $stm->bindValue("cargaHoraria", $disciplina->getCargaHoraria());
        $stm->bindValue("id", $disciplina->getId());
        $stm->execute();
    }
}