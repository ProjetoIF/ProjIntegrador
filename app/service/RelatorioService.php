<?php
class RelatorioService
{
    public function calcularRequisicaoGeral(array $requisicoes): array
    {
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
    public function monthCount(array $requisicoes): int
    {
        $monthCount = 0;
        $mesAtual = date('m'); // Mês atual
        $anoAtual = date('Y'); // Ano atual

        foreach ($requisicoes as $requisicao) {
            $data = strtotime($requisicao->getDataAula());
            $mes = date("m", $data);
            $ano = date("Y",$data);
            if($mes == $mesAtual && $ano == $anoAtual){
                $monthCount++;
            }
        }

        return $monthCount;
    }

    public function yearCount(array $requisicoes): int
    {
        $yearCount = 0;
        $anoAtual = date('Y'); // Ano atual

        foreach ($requisicoes as $requisicao) {
            $data = strtotime($requisicao->getDataAula());
            $ano = date("Y",$data);
            if($ano == $anoAtual){
                $yearCount++;
            }
        }
        return $yearCount;
    }

    public function analiseCount(array $requisicoes): int
    {
        $analiseCount = 0;

        foreach ($requisicoes as $requisicao) {
            $status = $requisicao->getStatus();
            if($status == "ENVIADO"){
                $analiseCount++;
            }
        }
        return $analiseCount;
    }

    public function alteracaoCount(array $requisicoes): int
    {
        $alteracaoCount = 0;

        foreach ($requisicoes as $requisicao) {
            $status = $requisicao->getStatus();
            if($status == "REJEITADO"){
                $alteracaoCount++;
            }
        }
        return $alteracaoCount;
    }

    public function reqPorMes(array $requisicoes)
    {
        $reqPorMes = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            8 => 0,
            10 => 0,
            11 => 0,
            12 => 0
        ];

        $reqPorMes = [
            1 => [
                "nome" => "Janeiro",
                "count" => 0
            ],
            2 => [
                "nome" => "Fevereiro",
                "count" => 0
            ],
            3 => [
                "nome" => "Março",
                "count" => 0
            ],
            4 => [
                "nome" => "Abril",
                "count" => 0
            ],
            5 => [
                "nome" => "Maio",
                "count" => 0
            ],
            6 => [
                "nome" => "Junho",
                "count" => 0
            ],
            7 => [
                "nome" => "Julho",
                "count" => 0
            ],
            8 => [
                "nome" => "Agosto",
                "count" => 0
            ],
            9 => [
                "nome" => "Setembro",
                "count" => 0
            ],
            10 => [
                "nome" => "Outubro",
                "count" => 0
            ],
            11 => [
                "nome" => "Novembro",
                "count" => 0
            ],
            12 => [
                "nome" => "Dezembro",
                "count" => 0
            ]
        ];

        $anoAtual = date('Y');

        foreach ($requisicoes as $requisicao) {

            $data = strtotime($requisicao->getDataAula());
            $mes = date("m", $data);
            $ano = date("Y",$data);
            if($ano == $anoAtual){
                $reqPorMes[($mes)]["count"] = $reqPorMes[($mes)]["count"] + 1;
            }
        }

        return json_encode($reqPorMes);
    }
}
