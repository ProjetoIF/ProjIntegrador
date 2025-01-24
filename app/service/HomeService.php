<?php
class HomeService
{
    public function filtrarRequisicoesProximas(array $requisicoes, DateTime $dataAtual, int $quantidade = 4): array
    {
        // Filtrar as requisições pela data maior ou igual à data atual
        $requisicoesFiltradas = array_filter($requisicoes, function ($requisicao) use ($dataAtual) {
            $dataAula = new DateTime($requisicao->getDataAula());
            return $dataAula >= $dataAtual;
        });

        // Ordenar as requisições por data (crescente)
        usort($requisicoesFiltradas, function ($a, $b) {
            return (new DateTime($a->getDataAula())) <=> (new DateTime($b->getDataAula()));
        });

        // Retornar as N primeiras requisições
        return array_slice($requisicoesFiltradas, 0, $quantidade);
    }

    public function contarRejeitadas(array $requisicoes): int
    {
        return count(array_filter($requisicoes, function ($requisicao) {
            return $requisicao->getStatus() === "REJEITADO";
        }));
    }

    public function contarEnviadas(array $requisicoes): int
    {
        return count(array_filter($requisicoes, function ($requisicao) {
            return in_array($requisicao->getStatus(), ["ENVIADO", "CORRECAO"], true);
        }));
    }

    public function contarEmPreenchimento(array $requisicoes): int
    {
        return count(array_filter($requisicoes, function ($requisicao) {
            return $requisicao->getStatus() === "PREENCHIMENTO";
        }));
    }

    public function contarAprovadas(array $requisicoes): int
    {
        return count(array_filter($requisicoes, function ($requisicao) {
            return $requisicao->getStatus() === "APROVADO";
        }));
    }

}
