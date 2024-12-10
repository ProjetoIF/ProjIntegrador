<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/RequisicoesDAO.php");
require_once(__DIR__ . "/../dao/RequisicaoIngredienteDAO.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/RelatorioService.php");

class RelatorioController extends Controller
{
    private RequisicoesDAO $reqsuisicaoDAO;
    private RequisicaoIngredienteDAO $requisicaoIngredienteDAO;
    private TurmaDAO $turmaDAO;
    private UsuarioDAO $usuarioDAO;
    private RelatorioService $relatorioService;

    public function __construct()
    {
        if (!$this->usuarioLogado()) {
            exit;
        }

        $this->reqsuisicaoDAO = new RequisicoesDAO();
        $this->requisicaoIngredienteDAO = new RequisicaoIngredienteDAO();
        $this->turmaDAO = new TurmaDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->relatorioService = new RelatorioService();

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
    
            foreach ($dados["requisicoes"] as $req) {
                $req->setRequisicaoIngredinetes($this->requisicaoIngredienteDAO->findByRequisicaoId($req->getId()));
                $req->setTurma($this->turmaDAO->findById($req->getidTurma()));
                $req->getTurma()->setProfessor($this->usuarioDAO->findById($req->getTurma()->getIdProfessor()));
            }
    
            // Calcula a soma dos ingredientes utilizando o service
            $dados["somaIngredientes"] = $this->relatorioService->calcularRequisicaoGeral($dados["requisicoes"]);
    
        } else {
            $dados["requisicoes"] = [];
            $dados["somaIngredientes"] = [];
        }
    
        $this->loadView("relatorio/reqGeral.php", $dados);
    }
    
    
}
new RelatorioController();