<?php
class RequisicaoIngrediente{
    private ?int $idRequisicaoIngrediente;
    private ?int $idRequisicao;
    private ?Ingrediente $ingrediente;
    private ?int $quantidade;

    /**
     * Get the value of idRequisicaoIngrediente
     */
    public function getIdRequisicaoIngrediente(): ?int
    {
        return $this->idRequisicaoIngrediente;
    }

    /**
     * Set the value of idRequisicaoIngrediente
     */
    public function setIdRequisicaoIngrediente(?int $idRequisicaoIngrediente): self
    {
        $this->idRequisicaoIngrediente = $idRequisicaoIngrediente;

        return $this;
    }

    /**
     * Get the value of idRequisicao
     */
    public function getIdRequisicao(): ?int
    {
        return $this->idRequisicao;
    }

    /**
     * Set the value of idRequisicao
     */
    public function setIdRequisicao(?int $idRequisicao): self
    {
        $this->idRequisicao = $idRequisicao;

        return $this;
    }

    /**
     * Get the value of ingrediente
     */
    public function getIngrediente(): ?Ingrediente
    {
        return $this->ingrediente;
    }

    /**
     * Set the value of ingrediente
     */
    public function setIngrediente(?Ingrediente $ingrediente): self
    {
        $this->ingrediente = $ingrediente;

        return $this;
    }

    /**
     * Get the value of quantidade
     */
    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     */
    public function setQuantidade(?int $quantidade): self
    {
        $this->quantidade = $quantidade;

        return $this;
    }
}