<?php
#Classe controller para Turma
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/TurmaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/DisciplinaDAO.php");
require_once(__DIR__ . "/../service/TurmaService.php");
require_once(__DIR__ . "/../model/Turma.php");

class TurmaController extends Controller {

    private TurmaDAO $turmaDao;
    private TurmaService $turmaService;

    private DisciplinaDAO $disciplinaDAO;
    private UsuarioDAO $usuarioDAO;

    //Método construtor do controller - será executado a cada requisição a esta classe
    public function __construct() {
        if(! $this->usuarioLogado())
            exit;

        $this->turmaDao = new TurmaDAO();
        $this->turmaService = new TurmaService();
        $this->disciplinaDAO = new DisciplinaDAO();
        $this->usuarioDAO = new UsuarioDAO();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "") {
        $turmas = $this->turmaService->listTurma();
        $dados["lista"] = $turmas;

        $this->loadView("turma/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save() {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $anoInicio = trim($_POST['anoInicio']) ? trim($_POST['anoInicio']) : NULL;
        $semestre = trim($_POST['semestre']) ? trim($_POST['semestre']) : NULL;
        $idDisciplina = trim($_POST['disciplina']) ? trim($_POST['disciplina']) : NULL;
        $idProfessor = trim($_POST['professor']) ? trim($_POST['professor']) : NULL;

        //Cria objeto Turma
        $turma = new Turma();
        $turma->setNome($nome);
        $turma->setAnoDeInicio($anoInicio);
        $turma->setSemestre($semestre);
        $turma->setIdDisciplina($idDisciplina);
        $turma->setIdProfessor($idProfessor);

        //Validar os dados
        $erros = $this->turmaService->validarDados($turma);
        if(empty($erros)) {
            //Persiste o objeto
            try {
                if($dados["id"] == 0){
                    //Inserindo
                    $this->usuarioDAO->updateStatus($idProfessor, "ativo");
                    $this->turmaDao->insert($turma); 
                }  
                else { //Alterando
                    $turma->setId($dados["id"]);
                    $this->usuarioDAO->updateStatus($idProfessor, "ativo");
                    $this->turmaDao->update($turma);
                }

                //TODO - Enviar mensagem de sucesso
                $msg = "Turma salva com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                print_r($e);
                array_push($erros, "[Erro ao salvar a turma na base de dados.]");
            }
        }

        //Se há erros, volta para o formulário
        $dados["turma"] = $turma;
        $dados["disciplinas"] = $this->disciplinaDAO->list();
        $dados["professores"] = $this->usuarioDAO->list();
        $msgsErro = implode("<br>", $erros);
        $this->loadView("turma/form.php", $dados, $msgsErro);
    }

    //Método create
    protected function create() {
        $dados["id"] = 0;
        $dados["disciplinas"] = $this->disciplinaDAO->list();
        $dados["professores"] = $this->usuarioDAO->list();
        $this->loadView("turma/form.php", $dados);
    }

    //Método edit
    protected function edit() {
        $turma = $this->findTurmaById();
        
        if($turma) {
            //Setar os dados
            $dados["id"] = $turma->getId();
            $dados["turma"] = $turma;
            $dados["disciplinas"] = $this->disciplinaDAO->list();
            $dados["professores"] = $this->usuarioDAO->list();

            $this->loadView("turma/form.php", $dados);
        } else 
            $this->list("Turma não encontrada");
    }

    //Método para excluir
    protected function delete() {
        $turma = $this->findTurmaById();
        if($turma) {
            //Excluir
            if ($this->turmaDao->isTurmaCadastradoNaRequisicao($turma->getId())) {
                $this->list("Turma não pode ser excluída! Essa turma possui uma requisição");
            } else {
                $this->turmaDao->deleteById($turma->getId());
                $this->list("", "Turma excluída com sucesso!");
            }
        } else {
            //Mensagem que não encontrou a turma
            $this->list("Turma não encontrada!");
        }               
    }

    //Método para buscar a turma com base no ID recebido por parâmetro GET
    private function findTurmaById() {
        $id = 0;
        if(isset($_GET['id']))
            $id = $_GET['id'];

        $turma = $this->turmaDao->findById($id);
        return $turma;
    }
}

#Criar objeto da classe para assim executar o construtor
new TurmaController();
