<?php
# Nome do arquivo: UnidadeDeMedidaDAO.php
# Objetivo: classe DAO para o model de UnidadeDeMedida

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/UnidadeDeMedida.php");

class UnidadeDeMedidaDAO {

    // Método para listar todas as unidades de medida
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM UnidadeDeMedida ORDER BY nome";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUnidades($result);
    }

    // Método para buscar uma unidade de medida por ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM UnidadeDeMedida WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $unidades = $this->mapUnidades($result);

        if (count($unidades) == 1) {
            return $unidades[0];
        } elseif (count($unidades) == 0) {
            return null;
        }

        die("UnidadeDeMedidaDAO.findById() - Erro: mais de uma unidade encontrada.");
    }

    // Método para inserir uma nova unidade de medida
    public function insert(UnidadeDeMedida $unidade) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO UnidadeDeMedida (nome, sigla) VALUES (:nome, :sigla)";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":nome", $unidade->getNome());
        $stm->bindValue(":sigla", $unidade->getSigla());
        $stm->execute();
    }

    // Método para atualizar uma unidade de medida existente
    public function update(UnidadeDeMedida $unidade) {
        $conn = Connection::getConn();

        $sql = "UPDATE UnidadeDeMedida SET nome = :nome, sigla = :sigla WHERE id = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":nome", $unidade->getNome());
        $stm->bindValue(":sigla", $unidade->getSigla());
        $stm->bindValue(":id", $unidade->getId());
        $stm->execute();
    }

    // Método para excluir uma unidade de medida pelo ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM UnidadeDeMedida WHERE id = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    // Método para contar o número de unidades de medida
    public function count() {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) total FROM UnidadeDeMedida";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    // Método para mapear registros do banco de dados para objetos UnidadeDeMedida
    private function mapUnidades($result) {
        $unidades = array();
        foreach ($result as $reg) {
            $unidade = new UnidadeDeMedida();
            $unidade->setId($reg['id']);
            $unidade->setNome($reg['nome']);
            $unidade->setSigla($reg['sigla']);
            array_push($unidades, $unidade);
        }

        return $unidades;
    }
}
?>
