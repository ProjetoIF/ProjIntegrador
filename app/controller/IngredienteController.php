<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/IngredienteDAO.php");
require_once(__DIR__ . "/../service/IngredienteService.php");
require_once(__DIR__ . "/../model/Ingrediente.php");
require_once(__DIR__ . "/../service/SalvarImagemService.php");
require_once(__DIR__ . "/../dao/UnidadeDeMedidaDAO.php");

class IngredienteController extends Controller
{
    private IngredienteService $ingredienteService;
    private IngredientesDAO $ingredientesDAO;
    private SalvarImagemService $salvarImagemService;
    private UnidadeDeMedidaDAO $unidadeDeMedidaDAO;

    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;
        $this->ingredienteService = new IngredienteService();
        $this->ingredientesDAO = new IngredientesDAO();
        $this->salvarImagemService = new SalvarImagemService();
        $this->unidadeDeMedidaDAO = new UnidadeDeMedidaDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $ingredientes = $this->ingredientesDAO->list();
        $dados["lista"] = $ingredientes;

        $this->loadView("ingrediente/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save() {
        $dados["id"] = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $nome = !empty(trim($_POST['nome'])) ? trim($_POST['nome']) : NULL;
        $unidadeDeMedida = !empty(trim($_POST['unidadeDeMedida'])) ? trim($_POST['unidadeDeMedida']) : NULL;
        $descricao = !empty(trim($_POST['descricao'])) ? trim($_POST['descricao']) : NULL;

        // Recuperar o caminho da imagem atual (se existir)
        $caminhoImagem = (isset($dados["ingrediente"]) && is_object($dados["ingrediente"])) ? $dados["ingrediente"]->getCaminhoImagem() : NULL;

        // Processar o upload da nova imagem (se houver)
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $nomeArquivo = $this->salvarImagemService->salvarImagem($_FILES['imagem'], 'ingrediente');
            if ($nomeArquivo) {
                $caminhoImagem = $nomeArquivo;
            } else {
                echo "Erro ao salvar a imagem.";
            }
        }

        // Criar objeto Ingrediente
        $ingrediente = new Ingrediente();
        $ingrediente->setNome($nome);
        $ingrediente->setUnidadeDeMedida($unidadeDeMedida);
        $ingrediente->setDescricao($descricao);
        $ingrediente->setCaminhoImagem($caminhoImagem);

        // Validar os dados
        $erros = $this->ingredienteService->validarDados($ingrediente);

        if (empty($erros)) {
            try {
                if ($dados["id"] === 0) {
                    $this->ingredientesDAO->insert($ingrediente);
                } else {
                    $ingrediente->setId($dados["id"]);
                    $this->ingredientesDAO->update($ingrediente);
                }

                $msg = "Ingrediente salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                array_push($erros, "Erro ao salvar o ingrediente na base de dados.");
            }
        }

        $dados["ingrediente"] = $ingrediente;
        $dados["nome"] = $ingrediente->getNome();
        $dados["unidadeDeMedida"] = $ingrediente->getUnidadeDeMedida();
        $dados["descricao"] = $ingrediente->getDescricao();
        $dados["caminhoImagem"] = $ingrediente->getCaminhoImagem();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("ingrediente/form.php", $dados, $msgsErro);
    }
    

    protected function create() {
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $dados["unidades"] = $this->unidadeDeMedidaDAO->list();
        $this->loadView("ingrediente/form.php", $dados);
    }

    protected function edit() {
        $ingrediente = $this->findIngredienteById();

        if($ingrediente) {

            //Setar os dados
            $dados["id"] = $ingrediente->getId();
            $dados["ingrediente"] = $ingrediente;
            $dados["nome"] = $ingrediente->getNome();
            $dados["unidadeDeMedida"] = $ingrediente->getUnidadeDeMedida();
            $dados["descricao"] = $ingrediente->getDescricao();
            $dados["caminhoImagem"] = $ingrediente->getCaminhoImagem();

            $this->loadView("ingrediente/form.php", $dados);
        } else
            $this->list("Ingrediente não encontrado");
    }

    protected function delete() {
        $ingrediente = $this->findIngredienteById();
        if($ingrediente) {
            //Excluir
            $this->ingredientesDAO->deleteById($ingrediente->getId());
            $this->list("", "Ingrediente excluído com sucesso!");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Ingrediente não encontrado!");

        }
    }

    private function findIngredienteById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $ingrediente = $this->ingredientesDAO->findById($id);
        return $ingrediente;
    }
}
new IngredienteController();