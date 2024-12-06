<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/RequisicoesDAO.php");
require_once(__DIR__ . "/../dao/RequisicaoIngredienteDAO.php");

class RelatorioController extends Controller
{
    private RequisicoesDAO $reqsuisicaoDAO;
    private RequisicaoIngredienteDAO $requisicaoIngredienteDAO;

    public function __construct()
    {
        if (!$this->usuarioLogado()) {
            exit;
        }

        $this->reqsuisicaoDAO = new RequisicoesDAO();
        $this->requisicaoIngredienteDAO = new RequisicaoIngredienteDAO();

        $this->handleAction();
    }

    protected function home() {

        $dados = [""];
        $this->loadView("relatorio/home.php", $dados);
    }

    protected function reqGeral() {
        if (isset($_GET['inicio']) && isset($_GET['fim'])) {
            $dataDeIncio = $_GET['inicio'];
            $dataDeFim = $_GET['fim'];
    
            // Busca as requisições no intervalo de datas
            $dados["requisicoes"] = $this->reqsuisicaoDAO->findByDateRange($dataDeIncio, $dataDeFim, "APROVADO");
            $dados["count"] = $this->reqsuisicaoDAO->countByDateRange($dataDeIncio, $dataDeFim, "APROVADO");

            $dados["reqIn"] = [];
            foreach ($dados["requisicoes"] as $req) {
                $dados["reqIn"][] = $this->requisicaoIngredienteDAO->findByRequisicaoId($req->getId());
            }
            
        } else {
            $dados["requisicoes"] = []; // Apenas necessário se a função puder retornar `null` ou outra estrutura
        }
    
        $this->loadView("relatorio/reqGeral.php", $dados);
    }
    
}
new RelatorioController();