<?php

class Disciplina
{
private ?int $id;
private ?string $nome;
private ?int $cargaHoraria;

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

    public function getCargaHoraria(): ?int
    {
        return $this->cargaHoraria;
    }

    public function setCargaHoraria(?int $cargaHoraria): void
    {
        $this->cargaHoraria = $cargaHoraria;
    }
}