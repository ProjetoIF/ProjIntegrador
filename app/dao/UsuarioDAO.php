<?php
#Nome do arquivo: UsuarioDAO.php
#Objetivo: classe DAO para o model de Usuario

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {

    //Método para listar os usuaários a partir da base de dados
    public function list() {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u ORDER BY u.nomeCompleto";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->mapUsuarios($result);
    }

    //Método para buscar um usuário por seu ID
    public function findById(int $id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE u.idUsuario = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1)
            return $usuarios[0];
        elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" . 
            " - Erro: mais de um usuário encontrado.");
    }


    //Método para buscar um usuário por seu login e senha
    public function findByLoginSenha(string $login, string $senha) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
               " WHERE BINARY u.login = ?";
        $stm = $conn->prepare($sql);    
        $stm->execute([$login]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if(count($usuarios) == 1) {
            //Tratamento para senha criptografada
            if(password_verify($senha, $usuarios[0]->getSenha()))
                return $usuarios[0];
            else
                return null;
        } elseif(count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByLoginSenha()" . 
            " - Erro: mais de um usuário encontrado.");
    }

    //Método para inserir um Usuario
    public function insert(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO usuarios (nomeCompleto, login, senha, papel, telefone, email, ativo, caminhoImagem)" .
               " VALUES (:nome, :login, :senha, :papel, :telefone, :email, :ativo, :caminhoImagem)";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("login", $usuario->getLogin());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("papel", $usuario->getPapel());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("ativo", 0);
        $stm->bindValue("caminhoImagem", $usuario->getCaminhoImagem());
        $stm->execute();
    }

    //Método para atualizar um Usuario
    public function update(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET nomeCompleto = :nome, login = :login," .
               " senha = :senha, papel = :papel, telefone = :telefone, email = :email, caminhoImagem = :caminhoImagem".
               " WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("login", $usuario->getLogin());
        $senhaCript = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("papel", $usuario->getPapel());
        $stm->bindValue("id", $usuario->getId());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("caminhoImagem", $usuario->getCaminhoImagem());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM usuarios WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function count() {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) total FROM usuarios";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["total"];
    }

    //Método para converter um registro da base de dados em um objeto Usuario
    private function mapUsuarios($result) {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['idUsuario']);
            $usuario->setNome($reg['nomeCompleto']);
            $usuario->setLogin($reg['login']);
            $usuario->setSenha($reg['senha']);
            $usuario->setPapel($reg['papel']);
            $usuario->setTelefone($reg['telefone']);
            $usuario->setEmail($reg['email']);
            $usuario->setAtivo($reg['ativo']);
            $usuario->setCaminhoImagem($reg['caminhoImagem']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    public function updateLogin(Usuario $usuario, $newLogin)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET login = :login WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("login", $newLogin);
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function updateEmail(Usuario $usuario, $newEmail)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET email = :email WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("email", $newEmail);
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function updateTelefone(Usuario $usuario, $newTelefone)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET telefone = :telefone WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("telefone", $newTelefone);
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function updateSenha(Usuario $usuario, $newSenha)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET senha = :senha WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $senhaCript = password_hash($newSenha, PASSWORD_DEFAULT);
        $stm->bindValue("senha", $senhaCript);
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function updateImg(Usuario $usuario, $newImg)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET caminhoImagem = :caminhoImagem WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("caminhoImagem", $newImg);
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    //Método para atualizar um Usuario sem alterar a senha
    public function updateNoPass(Usuario $usuario) {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET nomeCompleto = :nome, login = :login," .
               " papel = :papel, telefone = :telefone, email = :email, caminhoImagem = :caminhoImagem".
               " WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("login", $usuario->getLogin());
        $stm->bindValue("papel", $usuario->getPapel());
        $stm->bindValue("id", $usuario->getId());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("caminhoImagem", $usuario->getCaminhoImagem());
        $stm->execute();
    }

    public function isUsuarioCadastradoNaTurma(int $idUsuario) {
        // Obtenha a conexão com o banco
        $conn = Connection::getConn();
    
        // SQL para verificar se o usuário (idUsuario) é professor de alguma turma
        $sql = "SELECT COUNT(*) AS total
                FROM turmas
                WHERE idProfessor = ?";
    
        // Preparando e executando a consulta
        $stm = $conn->prepare($sql);
        $stm->execute([$idUsuario]);
    
        // Obtendo o resultado
        $result = $stm->fetch();
    
        // Verificando se o usuário está cadastrado em alguma turma
        if ($result['total'] > 0) {
            return true;  // Usuário está cadastrado em uma turma
        } else {
            return false; // Usuário não está cadastrado em nenhuma turma
        }
    }
    
    public function updateStatus(int $usuarioId, $status)
    {
        if ($status == "ativo") {
            $ativo = 1;
        }
        if ($status == "inativo") {
            $ativo = 0;
        }

        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET ativo = :ativo WHERE idUsuario = :id";
        
        $stm = $conn->prepare($sql);
        $stm->bindValue("ativo", $ativo);
        $stm->bindValue("id", $usuarioId);
        $stm->execute();
    }

    public function verifyLoginUsage($login)
    {
        $conn = Connection::getConn();
    
        $sql = "SELECT COUNT(*) AS total
                FROM usuarios
                WHERE login = ?";
    
        // Preparando e executando a consulta
        $stm = $conn->prepare($sql);
        $stm->execute([$login]);
    
        // Obtendo o resultado
        $result = $stm->fetch();
    
        if ($result['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

}