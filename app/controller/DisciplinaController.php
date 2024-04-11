<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../model/Disciplina.php");
require_once(__DIR__ . "/../service/DisciplinaService.php");
class DisciplinaController extends Controller
{
    private DisciplinaDAO $disciplinaDao;

    public function __construct()
    {
        if (! $this->usuarioLogado())
            exit;

        $this->disciplinaDao = new DisciplinaDAO();

        $this->disciplinaService = new DisciplinaService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = ""){
        $disciplinas = $this->disciplinaDao->list();
        $dados["lista"] = $disciplinas;

        $this->loadView("disciplina/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function create() {
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $this->loadView("disciplina/form.php", $dados);
    }

    protected function save() {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $cargaHoraria = trim($_POST['cargaHoraria']) ? trim($_POST['cargaHoraria']) : NULL;


        //Cria objeto Usuario
        $disciplina = new Disciplina();
        $disciplina->setNome($nome);
        $disciplina->setCargaHoraria($cargaHoraria);

        //Validar os dados
        $erros = $this->disciplinaService->validarDados($disciplina);
        if(empty($erros)) {
            //Persiste o objeto
            try {

                if($dados["id"] == 0)  //Inserindo
                    $this->disciplinaDao->insert($disciplina);
                else { //Alterando
                    $disciplina->setId($dados["id"]);
                    $this->disciplinaDao->update($disciplina);
                }

                //TODO - Enviar mensagem de sucesso
                $msg = "Disciplina salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                array_push($erros, "[Erro ao salvar a disciplina na base de dados.]");
                //$erros = "[Erro ao salvar a disciplina na base de dados.]";
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["diciplina"] = $disciplina;
        $dados["cargaHoraria"] = $cargaHoraria;

        $msgsErro = implode("<br>", $erros);
        $this->loadView("disciplina/form.php", $dados, $msgsErro);
    }

    protected function delete() {
        $disciplina = $this->findDisciplinaById();
        if($disciplina) {
            //Excluir
            $this->disciplinaDao->deleteById($disciplina->getId());
            $this->list("", "Disciplina excluída com sucesso!");
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Disciplina  não encontrada!");

        }
    }

    private function findDisciplinaById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $disciplina = $this->disciplinaDao->findById($id);
        return $disciplina;
    }

    protected function edit() {
        $disciplina = $this->findDisciplinaById();

        if($disciplina) {

            //Setar os dados
            $dados["id"] = $disciplina->getId();
            $dados["disciplina"] = $disciplina;
            $dados["nome"] = $disciplina->getNome();
            $dados["cargaHoraria"] = $disciplina->getCargaHoraria();

            $this->loadView("disciplina/form.php", $dados);
        } else
            $this->list("Disciplina não encontrada");
    }
}
new DisciplinaController();
