<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");
require_once(__DIR__ . "/../service/SalvarImagemService.php");

class UsuarioController extends Controller
{

    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;
    private SalvarImagemService $salvarImagemService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (! $this->usuarioLogado())
            exit;

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->salvarImagemService = new SalvarImagemService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $usuarios = $this->usuarioDao->list();
        //print_r($usuarios);
        $dados["lista"] = $usuarios;

        $this->loadView("usuario/list.php", $dados, $msgErro, $msgSucesso);
    }

    protected function save()
    {
        //Captura os dados do formulário
        $dados["id"] = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
        $login = trim($_POST['login']) ? trim($_POST['login']) : NULL;
        $senha = trim($_POST['senha']) ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) ? trim($_POST['conf_senha']) : NULL;
        $papel = trim($_POST['papel']) ? trim($_POST['papel']) : NULL;
        $telefone = trim($_POST['telefone']) ? trim($_POST['telefone']) : NULL;
        $email = trim($_POST['email']) ? trim($_POST['email']) : NULL;
        $caminhoImagem = trim($_POST['imagemAtual']) ? trim($_POST['imagemAtual']) : NULL;
        $alterarSenha = $_POST["alterarSenha"];

        if ($alterarSenha == "yes") {
            $alterarSenhaBoolean = true;
        } else {
            $alterarSenhaBoolean = false;
        }

        // Recuperar o caminho da imagem atual (se existir)
        //$caminhoImagem = '';//(isset($dados["usuario"]) && is_object($dados["usuario"])) ? $dados["usuario"]->getCaminhoImagem() : NULL;

        //Cria objeto Usuario
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setLogin($login);
        $usuario->setSenha($senha);
        $usuario->setPapel($papel);
        $usuario->setTelefone($telefone);
        $usuario->setEmail($email);
        $usuario->setCaminhoImagem($caminhoImagem);

        // print_r($usuario);
        // exit;

        //Validar os dados
        $erros = $this->usuarioService->validarDados($usuario, $confSenha, $alterarSenhaBoolean);
        if (empty($erros)) {
            // Processar o upload da nova imagem (se houver)
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $nomeArquivo = $this->salvarImagemService->salvarImagem($_FILES['imagem'], 'usuario');
                if ($nomeArquivo) {
                    //$caminhoImagem = $nomeArquivo;
                    $usuario->setCaminhoImagem($nomeArquivo);
                } else {
                    echo "Erro ao salvar a imagem.";
                }
            }

            if (! $usuario->getCaminhoImagem()) {
                $usuario->setCaminhoImagem(Usuario::IMG_DEFAULT);
            }


            //Persiste o objeto
            try {

                if ($dados["id"] == 0)  //Inserindo
                    $this->usuarioDao->insert($usuario);
                else { //Alterando
                    $usuario->setId($dados["id"]);
                    if ($alterarSenhaBoolean) { // se for alterar a senha
                        $this->usuarioDao->update($usuario);
                    } else {
                        $this->usuarioDao->updateNoPass($usuario);
                    }
                }

                //TODO - Enviar mensagem de sucesso
                $msg = "Usuário salvo com sucesso.";
                $this->list("", $msg);
                exit;
            } catch (PDOException $e) {
                array_push($erros, "[Erro ao salvar o usuário na base de dados.]");
                //$erros = "[Erro ao salvar o usuário na base de dados.]";
            }
        }

        //Se há erros, volta para o formulário

        //Carregar os valores recebidos por POST de volta para o formulário
        $dados["usuario"] = $usuario;
        $dados["confSenha"] = $confSenha;
        $dados["papeis"] = UsuarioPapel::getAllAsArray();
        $dados["telefone"] = $usuario->getTelefone();
        $dados["email"] = $usuario->getEmail();
        //$dados["caminhoImagem"] = $usuario->getCaminhoImagem();

        $msgsErro = implode("<br>", $erros);
        $this->loadView("usuario/form.php", $dados, $msgsErro);
    }

    //Método create
    protected function create()
    {
        //echo "Chamou o método create!";

        $dados["id"] = 0;
        $dados["papeis"] = UsuarioPapel::getAllAsArray();
        $this->loadView("usuario/form.php", $dados);
    }

    //Método edit
    protected function edit()
    {
        $usuario = $this->findUsuarioById();

        if ($usuario) {
            $usuario->setSenha("");

            //Setar os dados
            $dados["id"] = $usuario->getId();
            $dados["usuario"] = $usuario;
            $dados["papeis"] = UsuarioPapel::getAllAsArray();
            $dados["telefone"] = $usuario->getTelefone();
            $dados["email"] = $usuario->getEmail();
            //$dados["caminhoImagem"] = $usuario->getCaminhoImagem();

            $this->loadView("usuario/form.php", $dados);
        } else
            $this->list("Usuário não encontrado");
    }

    //Método para excluir
    protected function delete()
    {
        $usuario = $this->findUsuarioById();
        if ($usuario) {
            //Excluir
            if ($this->usuarioDao->isUsuarioCadastradoNaTurma($usuario->getId())) {
                $this->list("Usuário não pode ser excluído");
            }else {
                $this->usuarioDao->deleteById($usuario->getId());
                $this->list("", "Usuário excluído com sucesso!");
            }
        } else {
            //Mensagem q não encontrou o usuário
            $this->list("Usuário não encontrado!");
        }
    }

    protected function listJson()
    {
        $listaUsuarios = $this->usuarioDao->list();
        $json = json_encode($listaUsuarios);
        echo $json;
    }

    //Método para buscar o usuário com base no ID recebido por parâmetro GET
    private function findUsuarioById()
    {
        $id = 0;
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $usuario = $this->usuarioDao->findById($id);
        return $usuario;
    }

    protected function profile(string $msgErro = "", string $msgSucesso = "")
    {
        $usuario = $this->usuarioDao->findById($_SESSION[SESSAO_USUARIO_ID]);
        $dados["usuario"] = $usuario;

        $this->loadView("usuario/profile.php", $dados, $msgErro, $msgSucesso);
    }

    protected function editLogin()
    {
        if (isset($_GET['newLogin']) && isset($_GET['userId'])) {
            $newLogin = $_GET['newLogin'];
            $userId = $_GET['userId'];

            $usuario = $this->usuarioDao->findById($userId);
            $this->usuarioDao->updateLogin($usuario, $newLogin);
        }
    }

    protected function editEmail()
    {
        if (isset($_GET['newEmail']) && isset($_GET['userId'])) {
            $newEmail = $_GET['newEmail'];
            $userId = $_GET['userId'];

            $usuario = $this->usuarioDao->findById($userId);
            $this->usuarioDao->updateEmail($usuario, $newEmail);
        }
    }

    protected function editTelefone()
    {
        if (isset($_GET['newTelefone']) && isset($_GET['userId'])) {
            $newTelefone = $_GET['newTelefone'];
            $userId = $_GET['userId'];

            $usuario = $this->usuarioDao->findById($userId);
            $this->usuarioDao->updateTelefone($usuario, $newTelefone);
        }
    }
    protected function editSenha()
    {
        if (isset($_GET['newSenha']) && isset($_GET['userId'])) {
            $newSenha = $_GET['newSenha'];
            $userId = $_GET['userId'];

            $usuario = $this->usuarioDao->findById($userId);
            $this->usuarioDao->updateSenha($usuario, $newSenha);
        }
    }
    protected function editImg()
    {
        header('Content-Type: application/json'); // Define o cabeçalho para JSON

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK && isset($_POST['userId'])) {
            $nomeArquivo = $this->salvarImagemService->salvarImagem($_FILES['imagem'], 'usuario');
            $userId = $_POST['userId'];
            $usuario = $this->usuarioDao->findById($userId);

            if ($nomeArquivo) {
                $this->usuarioDao->updateImg($usuario, $nomeArquivo);
                echo json_encode(['success' => true, 'message' => 'Imagem atualizada com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao salvar a imagem.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
        }
    }

    protected function returnImage()
    {
        header('Content-Type: application/json'); // Define o cabeçalho para JSON

        if (isset($_GET['userid'])) {
            $userId = intval($_GET['userid']); // Converte o ID para inteiro

            // Busca o usuário no banco de dados
            $usuario = $this->usuarioDao->findById($userId);

            // Verifica se o usuário foi encontrado
            if ($usuario !== null) {
                echo json_encode([
                    'success' => true,
                    'imagePath' => BASEURL_USER_IMG.$usuario->getCaminhoImagem(),
                ]);
                return;
            }

            // Caso o usuário não seja encontrado
            echo json_encode([
                'success' => false,
                'message' => 'Usuário não encontrado.',
            ]);
            return;
        }

        // Caso o parâmetro 'userid' não seja enviado
        echo json_encode([
            'success' => false,
            'message' => 'Parâmetro "userid" não especificado.',
        ]);
        return;
    }
}


#Criar objeto da classe para assim executar o construtor
new UsuarioController();
