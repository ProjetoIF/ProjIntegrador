<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UnidadeDeMedidaDAO.php");
require_once(__DIR__ . "/../model/UnidadeDeMedida.php");
require_once(__DIR__ . "/../service/UnidadeDeMedidaService.php");

class UnidadeDeMedidaController extends Controller
{
    private UnidadeDeMedidaService $unidadeDeMedidaService;
    private UnidadeDeMedidaDAO $unidadeDeMedidaDAO;

    public function __construct()
    {
        if (!$this->usuarioLogado())
            exit;

        $this->unidadeDeMedidaService = new UnidadeDeMedidaService();
        $this->unidadeDeMedidaDAO = new UnidadeDeMedidaDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $unidades = $this->unidadeDeMedidaDAO->list();
        $dados["lista"] = $unidades;

        $this->loadView("unidadeDeMedida/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save() {
        $dados["id"] = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $nome = !empty(trim($_POST['nome'])) ? trim($_POST['nome']) : NULL;
        $sigla = !empty(trim($_POST['sigla'])) ? trim($_POST['sigla']) : NULL;

        // Criar objeto UnidadeDeMedida
        $unidade = new UnidadeDeMedida();
        $unidade->setNome($nome);
        $unidade->setSigla($sigla);

        // Validar os dados
        $erros = $this->unidadeDeMedidaService->validarDados($unidade);

        if (empty($erros)) {
            try {
                if ($dados["id"] === 0) {
                    $this->unidadeDeMedidaDAO->insert($unidade);
                } else {
                    $unidade->setId($dados["id"]);
                    $this->unidadeDeMedidaDAO->update($unidade);
                }

                $msg = "Unidade de medida salva com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                print_r($e);
                array_push($erros, "Erro ao salvar a unidade de medida na base de dados.");
            }
        }

        $dados["unidade"] = $unidade;
        $dados["nome"] = $unidade->getNome();
        $dados["sigla"] = $unidade->getSigla();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("unidadeDeMedida/form.php", $dados, $msgsErro);
    }

    protected function create() {
        $dados["id"] = 0;
        $this->loadView("unidadeDeMedida/form.php", $dados);
    }

    protected function edit() {
        $unidade = $this->findUnidadeById();

        if ($unidade) {
            $dados["id"] = $unidade->getId();
            $dados["unidade"] = $unidade;
            $dados["nome"] = $unidade->getNome();
            $dados["sigla"] = $unidade->getSigla();

            $this->loadView("unidadeDeMedida/form.php", $dados);
        } else {
            $this->list("Unidade de medida não encontrada.");
        }
    }

    protected function delete() {
        $unidade = $this->findUnidadeById();

        if ($unidade) {

            if ($this->unidadeDeMedidaDAO->isUnidadeCadastradoNoIngrediente($unidade->getId())) {
                $this->list("Unidade de medida não pode ser excluída! Está sendo utilizada por um ingrediente!");
            } else {
                $this->unidadeDeMedidaDAO->deleteById($unidade->getId());
                $this->list("", "Unidade de medida excluída com sucesso!");
            }
        } else {
            $this->list("Unidade de medida não encontrada!");
        }
    }

    private function findUnidadeById() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        return $this->unidadeDeMedidaDAO->findById($id);
    }
}

new UnidadeDeMedidaController();