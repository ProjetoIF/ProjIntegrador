<?php
#Nome do arquivo: IngredientesDAO.php
#Objetivo: classe DAO para o model de Ingredientes

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Ingrediente.php");
require_once( __DIR__.'/UnidadeDeMedidaDAO.php');

class IngredientesDAO {

    
    //Método para listar os ingredientes a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM ingredientes ORDER BY nome";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapIngredientes($result);
    }

    //Método para buscar um ingrediente por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM ingredientes WHERE idIngrediente = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $ingredientes = $this->mapIngredientes($result);

        if(count($ingredientes) == 1)
            return $ingredientes[0];
        elseif(count($ingredientes) == 0)
            return null;

        die("IngredientesDAO.findById() - Erro: mais de um ingrediente encontrado.");
    }

    //Método para inserir um ingrediente
    public function insert(Ingrediente $ingrediente) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO ingredientes (nome, unidadeDeMedidaId, descricao, caminhoImagem)" .
            " VALUES (:nome, :unidadeDeMedida, :descricao, :caminhoImagem)";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":nome", $ingrediente->getNome());
        $stm->bindValue(":unidadeDeMedida", $ingrediente->getUnidadeDeMedida()->getId());
        $stm->bindValue(":descricao", $ingrediente->getDescricao());
        $stm->bindValue(":caminhoImagem", $ingrediente->getCaminhoImagem());
        $stm->execute();
    }

    //Método para atualizar um ingrediente
    public function update(Ingrediente $ingrediente) {
        $conn = Connection::getConn();

        $sql = "UPDATE ingredientes SET nome = :nome, unidadeDeMedidaId = :unidadeDeMedida," .
            " descricao = :descricao, caminhoImagem = :caminhoImagem WHERE idIngrediente = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":nome", $ingrediente->getNome());
        $stm->bindValue(":unidadeDeMedida", $ingrediente->getUnidadeDeMedida()->getId());
        $stm->bindValue(":descricao", $ingrediente->getDescricao());
        $stm->bindValue(":caminhoImagem", $ingrediente->getCaminhoImagem());
        $stm->bindValue(":id", $ingrediente->getId());
        $stm->execute();
    }

    //Método para excluir um ingrediente pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM ingredientes WHERE idIngrediente = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
    }

    //Método para contar o número de ingredientes
    public function count() {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) total FROM ingredientes";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    //Método para converter um registro da base de dados em um objeto Ingredientes
    private function mapIngredientes($result) {
        $ingredientes = array();
        foreach ($result as $reg) {
            $unidadeDeMedidaDAO = new UnidadeDeMedidaDAO();
            $ingrediente = new Ingrediente();
            $ingrediente->setId($reg['idIngrediente']);
            $ingrediente->setNome($reg['nome']);
            $ingrediente->setUnidadeDeMedida($unidadeDeMedidaDAO->findById($reg['unidadeDeMedidaId']));
            $ingrediente->setDescricao($reg['descricao']);
            $ingrediente->setCaminhoImagem($reg['caminhoImagem']);
            array_push($ingredientes, $ingrediente);
        }

        return $ingredientes;
    }

    public function isIngredienteCadastradoNaRequisicao(int $idIngrediente) {
        // Obtenha a conexão com o banco
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) AS total
                FROM requisicoesIngredientes
                WHERE idIngrediente = ?";
    
        // Preparando e executando a consulta
        $stm = $conn->prepare($sql);
        $stm->execute([$idIngrediente]);
    
        // Obtendo o resultado
        $result = $stm->fetch();

        if ($result['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

}

