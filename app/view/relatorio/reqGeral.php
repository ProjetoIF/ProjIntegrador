<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");

?>
<div class="nav-pages">
    <h3 class="nav-pages-title font-weight-bold poppins-extrabold">Criar uma requisição geral</h3>
    <a class="btn-padrao btn" href="<?= HOME_PAGE ?>"><i class="fa-solid fa-house"></i>Home</a>
</div>

<div class="container">
    <form action="" class="form-group row">
        <div class="col-12 col-md-6 d-flex align-items-center p-2">
            <h3 class="mb-0 mr-2 w-100">Data de inicio</h3>
            <input type="date" name="inicio" class="form-control">
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center p-2">
            <h3 class="mb-0 mr-2 w-100">Data de fim</h3>
            <input type="date" name="fim" class="form-control">
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
    <div class="row">
        <div class="col-6">
            <h4 class="mt-5">Total de requisições: </h4>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>