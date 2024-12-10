<?php 
class RelatorioService
{
    public function calcularRequisicaoGeral(array $requisicoes): array {
        $somaIngredientes = [];

        foreach ($requisicoes as $requisicao) {
            foreach ($requisicao->getRequisicaoIngredinetes() as $req) {
                $ingrediente = $req->getIngrediente();
                $quantidade = $req->getQuantidade();
                $unidade = $ingrediente->getUnidadeDeMedida();

                // Identificador único para o ingrediente (ID + Unidade)
                $key = $ingrediente->getId() . "_" . $unidade->getId();

                // Soma dos ingredientes
                if (!isset($somaIngredientes[$key])) {
                    $somaIngredientes[$key] = [
                        'id' => $ingrediente->getId(),
                        'nome' => $ingrediente->getNome(),
                        'quantidade' => 0,
                        'unidade' => $unidade->getNome() . " (" . $unidade->getSigla() . ")",
                    ];
                }

                $somaIngredientes[$key]['quantidade'] += $quantidade;
            }
        }

        return $somaIngredientes;
    }
}
?>