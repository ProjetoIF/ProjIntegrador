<?php

class RequisicaoStatus {

    public static string $SEPARADOR = "|";

    const PREENCHIMENTO = "PREENCHIMENTO";
    const ENVIADO = "ENVIADO";
    const APROVADO = "APROVADO";
    const REJEITADO = "REJEITADO";
    const CORRECAO = "CORRECAO";

    public static function getAllAsArray() {
        return [RequisicaoStatus::PREENCHIMENTO, RequisicaoStatus::ENVIADO,RequisicaoStatus::APROVADO,
            RequisicaoStatus::REJEITADO,RequisicaoStatus::CORRECAO,];
    }

}