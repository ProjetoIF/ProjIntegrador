
function usuarios() {
    //alert("Teste");
    const baseURL = document.getElementById("baseurl").value
    //console.log(baseURL);
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", 
                baseURL+"/controller/UsuarioController.php?action=listJson");

    xhttp.onload = function() {
        var json = xhttp.responseText;
        alert(json);
    }

    xhttp.send();
}