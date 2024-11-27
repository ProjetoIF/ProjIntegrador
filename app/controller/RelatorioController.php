<?php

require_once(__DIR__ . "/Controller.php");


class RelatorioController extends Controller
{
    public function __construct()
    {
        if (!$this->usuarioLogado()) {
            exit;
        }

        $this->handleAction();
    }

    protected function home() {

        $dados = [""];
        $this->loadView("relatorio/home.php", $dados);
    }

    protected function reqGeral() {

        $dados = [""];
        $this->loadView("relatorio/reqGeral.php", $dados);
    }
}
new RelatorioController();