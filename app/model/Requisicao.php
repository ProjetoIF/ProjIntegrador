<?php

class Requisicao
{
    private ?int $id;
    private ?string $descricao;
    private ?string $dataAula;
    private ?string $status;
    private ?int $idTurma;
    private ?string $motivoDevolucao;
    private ?Turma $turma;
    
    private ?array $requisicaoIngredinetes;

    public function __construct() {
       $this->requisicaoIngredinetes = array();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getDataAula(): ?string
    {
        return $this->dataAula;
    }

    public function setDataAula(?string $dataAula): void
    {
        $this->dataAula = $dataAula;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getIdTurma(): ?int
    {
        return $this->idTurma;
    }

    public function setIdTurma(?int $idTurma): void
    {
        $this->idTurma = $idTurma;
    }

    public function getMotivoDevolucao(): ?string
    {
        return $this->motivoDevolucao;
    }

    public function setMotivoDevolucao(?string $motivoDevolucao): void
    {
        $this->motivoDevolucao = $motivoDevolucao;
    }

    public function getTurma(): ?Turma
    {
        return $this->turma;
    }

    public function setTurma(?Turma $turma): self
    {
        $this->turma = $turma;

        return $this;
    }

    public function getRequisicaoIngredinetes(): ?array
    {
        return $this->requisicaoIngredinetes;
    }

    public function setRequisicaoIngredinetes(?array $requisicaoIngredinetes): self
    {
        $this->requisicaoIngredinetes = $requisicaoIngredinetes;

        return $this;
    }
}