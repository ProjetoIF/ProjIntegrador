<?php

class UnidadeDeMedida {

    private ?int $id;
    private ?string $nome;
    private ?string $sigla;

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?String
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?String $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of sigla
     */
    public function getSigla(): ?String
    {
        return $this->sigla;
    }

    /**
     * Set the value of sigla
     */
    public function setSigla(?String $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }
}