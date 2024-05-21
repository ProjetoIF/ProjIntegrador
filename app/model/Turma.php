<?php

class Turma
{
private ?int $id;
private ?string $nome;
private ?string $anoDeInicio;
private ?int $semestre;
private ?int $idProfessor;
private ?int $idDisciplina;
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

    public function getAnoDeInicio(): ?string
    {
        return $this->anoDeInicio;
    }

    public function setAnoDeInicio(?string $anoDeInicio): void
    {
        $this->anoDeInicio = $anoDeInicio;
    }

    public function getSemestre(): ?int
    {
        return $this->semestre;
    }

    public function setSemestre(?int $semestre): void
    {
        $this->semestre = $semestre;
    }

    public function getIdProfessor(): ?int
    {
        return $this->idProfessor;
    }

    public function setIdProfessor(?int $idProfessor): void
    {
        $this->idProfessor = $idProfessor;
    }

    public function getIdDisciplina(): ?int
    {
        return $this->idDisciplina;
    }

    public function setIdDisciplina(?int $idDisciplina): void
    {
        $this->idDisciplina = $idDisciplina;
    }

}