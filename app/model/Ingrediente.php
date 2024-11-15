<?php

class Ingrediente
{
    private ?int $id;
    private ?string $nome;
    // private ?string $unidadeDeMedida;
    private ?string $descricao;
    private ?string $caminhoImagem;
    private ?UnidadeDeMedida $unidadeDeMedida;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    public function getUnidadeDeMedida(): ?UnidadeDeMedida
    {
        return $this->unidadeDeMedida;
    }

    public function setUnidadeDeMedida(?UnidadeDeMedida $unidadeDeMedida): void
    {
        $this->unidadeDeMedida = $unidadeDeMedida;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
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