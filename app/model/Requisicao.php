<?php

class Requisicao
{
    private ?int $id;
    private ?string $descricao;
    private ?string $dataAula;
    private ?string $status;
    private ?int $idTurma;
    private ?string $motivoDevolucao;
    private ?Turma $Turma;

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
        return $this->Turma;
    }

    public function setTurma(?Turma $Turma): self
    {
        $this->Turma = $Turma;

        return $this;
    }
}