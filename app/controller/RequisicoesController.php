<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/enum/RequisicaoStatus.php");
require_once(__DIR__ . "/../dao/RequisicoesDAO.php");
require_once(__DIR__ . "/../service/RequisicoesService.php");
require_once(__DIR__ . "/../model/Requisicao.php");
require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/IngredienteDAO.php");
require_once(__DIR__ . "/../model/RequisicaoIngrediente.php");
require_once(__DIR__ . "/../dao/RequisicaoIngredienteDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");


class RequisicoesController extends Controller
{

    private RequisicoesDAO $requisicoesDAO;
    private RequisicoesService $requisicoesService;
    private TurmaDAO $turmaDao;
    private IngredientesDAO $ingredientesDAO;
    private RequisicaoIngrediente $requisicaoIngrediente;
    private RequisicaoIngredienteDAO $requisicaoIngredienteDAO;
    private DisciplinaDAO $disciplinaDAO;

    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        if ($this->usuarioIsAdmin()) {
            $this->loadView("errors/403.php", [], "", "");
            exit;
        }

        $this->turmaDao = new TurmaDAO();
        $this->requisicoesService = new RequisicoesService();
        $this->requisicoesDAO = new RequisicoesDAO();
        $this->ingredientesDAO = new IngredientesDAO();
        $this->requisicaoIngrediente = new RequisicaoIngrediente();
        $this->requisicaoIngredienteDAO = new RequisicaoIngredienteDAO();
        $this->disciplinaDAO = new DisciplinaDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $requisicoes = $this->requisicoesService->listRequisicoes();
        // print_r($requisicoes);
        // exit;
        $dados["lista"] = $requisicoes;

        $this->loadView("requisicao/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save()
    {
        //Captura os dados do formulário  descricao, dataaula, status, 
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $descricao = trim($_POST['descricao']) ? trim($_POST['descricao']) : NULL;
        $dataAula = trim($_POST['dataAula']) ? trim($_POST['dataAula']) : NULL;
        $idTurma = trim($_POST['turma']) ? trim($_POST['turma']) : NULL;


        //Cria objeto Usuario
        $requisicao = new Requisicao();
        $requisicao->setDescricao($descricao);
        $requisicao->setDataAula($dataAula);
        $requisicao->setIdTurma($idTurma);

        //Validar os dados
        $erros = $this->requisicoesService->validarDados($requisicao);
        if (empty($erros)) {
            //Persiste o objeto
            try {

                if ($dados["id"] == 0)  //Inserindo
                    $this->requisicoesDAO->insert($requisicao);
                else { //Alterando
                    $requisicao->setId($dados["id"]);
                    $this->requisicoesDAO->update($requisicao);
                }

                //TODO - Enviar mensagem de sucesso
                $msg = "Requisição salva com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                array_push($erros, "Erro ao salvar a requisição na base de dados." . $e);
                //$erros = "[Erro ao salvar o usuário na base de dados.]";
            }
        }
        echo implode("<br>", $erros);
        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário

        $dados["requisicao"] = $requisicao;
        $dados["descricao"] = $requisicao->getDescricao();
        $dados["dataAula"] = $requisicao->getDataAula();
        $dados["idTurma"] = $requisicao->getidTurma();


        $msgsErro = implode("<br>", $erros);
        $this->loadView("requisicao/form.php", $dados, $msgsErro);
    }

    protected function create()
    {
        //echo "Chamou o método create!";

        $dados["id"] = 0;

        $dados["turmas"] = $this->turmaDao->listByUser($_SESSION[SESSAO_USUARIO_ID]);

        $this->loadView("requisicao/form.php", $dados);
    }

    protected function edit()
    {
        $requisicao = $this->findRequisicaoById();

        if ($requisicao) {

            $dados["id"] = $requisicao->getId();
            $dados["requisicao"] = $requisicao;
            $dados["turmas"] = $this->turmaDao->listByUser($_SESSION[SESSAO_USUARIO_ID]);

            $this->loadView("requisicao/form.php", $dados);
        } else
            $this->list("Requisicao não encontrado");
    }

    protected function delete()
    {
        $requisicao = $this->findRequisicaoById();
        if ($requisicao) {
            //Excluir
            $this->requisicoesDAO->deleteById($requisicao->getId());
            $this->list("", "Requisição excluída com sucesso!");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Requisição não encontrada!");
        }
    }

    private function findRequisicaoById()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $requisicao = $this->requisicoesDAO->findById($id);
        return $requisicao;
    }

    protected function informIngredientes()
    {
        $requisicao = $this->findRequisicaoById();
        if (!$requisicao) {
            $this->list("Requisição não encontrada!");
            return;
        }
        $dados["requisicao"] = $requisicao;
        $dados["turma"] = $this->turmaDao->findById($requisicao->getidTurma());
        //print_r($dados["turma"]->getIdDisciplina());
        $dados["disciplina"] = $this->disciplinaDAO->findById($dados["turma"]->getIdDisciplina());
        //print_r($dados["disciplina"]);
        $dados["ingredientes"] = $this->ingredientesDAO->list();
        $dados["ingredientesSelecionados"] = $this->requisicaoIngredienteDAO->findByRequisicaoId($requisicao->getId());
        //print_r($dados["ingredientesSelecionados"]);
        $this->loadView("requisicao/informIngredientes.php", $dados);
    }

    protected function saveIngredientes()
    {
        if (isset($_POST['idRequisicao'], $_POST['idIngrediente'], $_POST['quantidade'])) {
            // Instanciar o objeto Ingrediente
            $ingrediente = $this->ingredientesDAO->findById($_POST['idIngrediente']);

            // Verificar se o ingrediente foi encontrado
            if ($ingrediente === null) {
                throw new Exception("Ingrediente não encontrado.");
            }

            // Configurar os valores no objeto RequisicaoIngrediente
            $this->requisicaoIngrediente->setIdRequisicao($_POST['idRequisicao']);
            $this->requisicaoIngrediente->setIngrediente($ingrediente); // Agora passa o objeto Ingrediente
            $this->requisicaoIngrediente->setQuantidade($_POST['quantidade']);
            // Salvar o objeto através do DAO

            if ($resultado = $this->requisicaoIngredienteDAO->verifyIngOnReq($_POST['idRequisicao'], $_POST['idIngrediente'])) {
                return;
            } else {
                return $this->requisicaoIngredienteDAO->insert($this->requisicaoIngrediente);
            }
        } else {
            throw new Exception("Valores insuficientes para salvar o ingrediente.");
        }
    }

    protected function listJsonSelectedIngredientes()
    {
        $requisicao = $this->findRequisicaoById();

        if (!$requisicao) {
            $this->list("Requisição não encontrada!");
            return;
        }
        $listaDeIngredientes = $this->requisicaoIngredienteDAO->findByRequisicaoId($requisicao->getId());
        $json = json_encode($listaDeIngredientes);
        echo $json;
    }

    protected function deleteIngDaReq()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $ingrediente = $this->requisicaoIngredienteDAO->findById($id);
        if ($ingrediente) {
            //Excluir
            $this->requisicaoIngredienteDAO->deleteById($ingrediente->getIdRequisicaoIngrediente());
            $this->list("", "Ingrediente excluído da requisicao com sucesso!");
        } else {
            $this->list("Ingrediente não encontrado na requisicao!");
        }
    }
    protected function verifyIng()
    {
        if (isset($_GET['idReq']) && isset($_GET['idIng'])){
            $idReq = $_GET['idReq'];
            $idIng = $_GET['idIng'];
        }
        $resultado = $this->requisicaoIngredienteDAO->verifyIngOnReq($idReq, $idIng);
        if ($resultado) {
            echo json_encode(['message' => 'Esse ingrediente já foi cadastrado!']);
        }
        else{
            echo json_encode(['message' => '']);
        }   
    }
}

new RequisicoesController();
