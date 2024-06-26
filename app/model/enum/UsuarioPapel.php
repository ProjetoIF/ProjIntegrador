<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class UsuarioPapel {

    public static string $SEPARADOR = "|";

    const PROFESSOR = "PROFESSOR";
    const ADMINISTRADOR = "ADMINISTRADOR";

    public static function getAllAsArray() {
        return [UsuarioPapel::PROFESSOR, UsuarioPapel::ADMINISTRADOR];
    }

}

