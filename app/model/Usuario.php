<?php 
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

require_once(__DIR__ . "/enum/UsuarioPapel.php");

class Usuario implements JsonSerializable {

    private ?int $id;
    private ?string $nome;
    private ?string $login;
    private ?string $senha;
    private ?string $papel;
    private ?string $telefone;
    private ?string $email;
    private ?int $ativo;
    private ?string $imagem;


    public function jsonSerialize(): array {
        return array("id" => $this->id,
                     "nome" => $this->nome,
                     "login" => $this->login,
                     "papel" => $this->papel,
                     "telefone"=> $this->telefone,
                     "ativo"=> $this->ativo);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getPapel(): ?string
    {
        return $this->papel;
    }

    public function setPapel(?string $papel): self
    {
        $this->papel = $papel;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getAtivo(): ?int
    {
        return $this->ativo;
    }

    public function setAtivo(?int $ativo): void
    {
        $this->ativo = $ativo;
    }
    public function isActive()
    {
        if($this->getAtivo() == 1){
            echo "Ativo";
        }else{
            echo "Inativo";
        }
    }

    public function getCaminhoImagem(): ?string
    {
        return $this->caminhoImagem;
    }

    public function setCaminhoImagem(?string $caminhoImagem): void
    {
        $this->caminhoImagem = $caminhoImagem;
    }
}