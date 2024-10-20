<?php
# Nome do arquivo: RequisicoesIngredientesDAO.php
# Objetivo: classe DAO para o model de RequisicoesIngredientes

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/RequisicaoIngrediente.php");
include_once(__DIR__ . "/../model/Ingrediente.php");
include_once(__DIR__ . "/IngredienteDAO.php");

class RequisicaoIngredienteDAO {

    // Método para listar todas as requisições de ingredientes
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoesIngredientes ORDER BY idRequisicaoIngrediente";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapRequisicoesIngredientes($result);
    }

    // Método para buscar uma requisição de ingrediente por ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoesIngredientes WHERE idRequisicaoIngrediente = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $requisicoesIngredientes = $this->mapRequisicoesIngredientes($result);

        if (count($requisicoesIngredientes) == 1) {
            return $requisicoesIngredientes[0];
        } elseif (count($requisicoesIngredientes) == 0) {
            return null;
        }

        die("RequisicoesIngredientesDAO.findById() - Erro: mais de uma requisição de ingrediente encontrada.");
    }

    // Método para inserir uma nova requisição de ingrediente
    public function insert(RequisicaoIngrediente $requisicaoIngrediente) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO requisicoesIngredientes (idRequisicao, idIngrediente, quantidade) " .
            "VALUES (:idRequisicao, :idIngrediente, :quantidade)";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":idRequisicao", $requisicaoIngrediente->getIdRequisicao());
        $stm->bindValue(":idIngrediente", $requisicaoIngrediente->getIngrediente()->getId());
        $stm->bindValue(":quantidade", $requisicaoIngrediente->getQuantidade());
        $stm->execute();
    }

    // Método para atualizar uma requisição de ingrediente existente
    public function update(RequisicaoIngrediente $requisicaoIngrediente) {
        $conn = Connection::getConn();

        $sql = "UPDATE requisicoesIngredientes SET idRequisicao = :idRequisicao, idIngrediente = :idIngrediente, " .
            "quantidade = :quantidade WHERE idRequisicaoIngrediente = :idRequisicaoIngrediente";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":idRequisicao", $requisicaoIngrediente->getIdRequisicao());
        $stm->bindValue(":idIngrediente", $requisicaoIngrediente->getIngrediente()->getId());
        $stm->bindValue(":quantidade", $requisicaoIngrediente->getQuantidade());
        $stm->bindValue(":idRequisicaoIngrediente", $requisicaoIngrediente->getIdRequisicaoIngrediente());
        $stm->execute();
    }

    // Método para excluir uma requisição de ingrediente pelo ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM requisicoesIngredientes WHERE idRequisicaoIngrediente = :id";
        $stm = $conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    // Método para buscar os ingredientes de uma requisicao por ID
    public function findByRequisicaoId(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM requisicoesIngredientes WHERE idRequisicao = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $requisicoesIngredientes = $this->mapRequisicoesIngredientes($result);

        return $requisicoesIngredientes;
    }

    // Método para mapear resultados do banco de dados para objetos RequisicaoIngrediente
    private function mapRequisicoesIngredientes($result) {
        $requisicoesIngredientes = array();
        $ingredientesDAO = new IngredientesDAO();

        foreach ($result as $reg) {
            $requisicaoIngrediente = new RequisicaoIngrediente();
            $requisicaoIngrediente->setIdRequisicaoIngrediente($reg['idRequisicaoIngrediente']);
            $requisicaoIngrediente->setIdRequisicao($reg['idRequisicao']);
            $requisicaoIngrediente->setIngrediente($ingredientesDAO->findById($reg['idIngrediente']));
            $requisicaoIngrediente->setQuantidade($reg['quantidade']);

            array_push($requisicoesIngredientes, $requisicaoIngrediente);
        }

        return $requisicoesIngredientes;
    }
}
