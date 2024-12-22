<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/RequisicoesDAO.php");
require_once(__DIR__ . "/../model/enum/RequisicaoStatus.php");
require_once(__DIR__ . "/../service/HomeService.php");

class HomeController extends Controller
{

    private UsuarioDAO $usuarioDao;
    private RequisicoesDAO $requisicaoDAO;
    private RequisicaoStatus $requisicoesStatus;
    private HomeService $homeService;

    public function __construct()
    {
        //Testar se o usuário está logado
        if (! $this->usuarioLogado()) {
            exit;
        }

        //Criar o objeto do UsuarioDAO
        $this->usuarioDao = new UsuarioDAO();
        $this->requisicaoDAO = new RequisicoesDAO();
        $this->requisicoesStatus = new RequisicaoStatus();
        $this->homeService = new HomeService();

        $this->handleAction();
    }

    protected function home()
    {
        // Obtenha as requisições
        $requisicoes = $this->requisicaoDAO->listByUsuario($_SESSION[SESSAO_USUARIO_ID]);

        // Filtrar e ordenar as requisições
        $requisicoesFiltradas = $this->homeService->filtrarRequisicoesProximas($requisicoes, new DateTime());

        // Calcular os números de status
        $dados["quantidadeRejeitadas"] = $this->homeService->contarRejeitadas($requisicoes);
        $dados["quantidadeEnviadas"] = $this->homeService->contarEnviadas($requisicoes);
        $dados["quantidadePreenchimento"] = $this->homeService->contarEmPreenchimento($requisicoes);

        // Passar as requisições filtradas para a view
        $dados["requisicoes"] = $requisicoesFiltradas;

        $dados["status"] = $this->requisicoesStatus->getAllAsArray();

        $this->loadView("home/home.php", $dados);
    }
}

//Criar o objeto da classe HomeController
new HomeController();
