
function usuarios() {
    //alert("Teste");

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", 
                "http://localhost/ProjIntegrador/app/controller/UsuarioController.php?action=listJson");

    xhttp.onload = function() {
        var json = xhttp.responseText;
        alert(json);
    }

    xhttp.send();
}