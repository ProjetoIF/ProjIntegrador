<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/IngredienteDAO.php");
require_once(__DIR__ . "/../service/IngredienteService.php");
require_once(__DIR__ . "/../model/Ingrediente.php");

class IngredienteController extends Controller
{
    private IngredienteService $ingredienteService;
    private IngredientesDAO $ingredientesDAO;

    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;
        $this->ingredienteService = new IngredienteService();
        $this->ingredientesDAO = new IngredientesDAO();

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
            $nomeArquivo = basename($_FILES['imagem']['name']);
            $diretorioDestino = __DIR__ . '/../uploads/' . $nomeArquivo;
    
            // Verificar se é realmente uma imagem
            $check = getimagesize($_FILES['imagem']['tmp_name']);
            if ($check !== false) {
                // Mover o arquivo para o diretório de destino
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorioDestino)) {
                    $caminhoImagem = '/uploads/' . $nomeArquivo;
                } else {
                    echo "Erro ao mover o arquivo.";
                }
            } else {
                echo "O arquivo enviado não é uma imagem válida.";
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
            // Persiste o objeto
            try {
                if ($dados["id"] === 0) {
                    // Inserindo
                    $this->ingredientesDAO->insert($ingrediente);
                } else {
                    // Alterando
                    $ingrediente->setId($dados["id"]);
                    $this->ingredientesDAO->update($ingrediente);
                }
    
                // Enviar mensagem de sucesso
                $msg = "Ingrediente salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                array_push($erros, "Erro ao salvar o ingrediente na base de dados.");
            }
        }
    
        // Se houver erros, volta para o formulário
        // Carregar os valores recebidos por POST de volta para o formulário
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