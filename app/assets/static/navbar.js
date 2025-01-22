
let closeWasClicl = false;

const openBtn = document.getElementById('open-btn');
const closeBtn = document.getElementById('close-btn');

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');

    openBtn.addEventListener('click', function() {
        sidebar.style.transform = "translateX(0%)";
        openBtn.style.visibility = "hidden"
        closeBtn.style.visibility = "visible"
        closeWasClicl = false
        //console.log(closeWasClicl)
    });

    closeBtn.addEventListener('click', function() {
        sidebar.style.transform = "translateX(-100%)";
        openBtn.style.visibility = "visible"
        closeBtn.style.visibility = "hidden"
        closeWasClicl = true
        //console.log(closeWasClicl)
    });
});
window.addEventListener("resize", function() {
    if (window.innerWidth > 1850) {
        // Em telas maiores que 1850, sempre mostrar a sidebar
        sidebar.style.transform = "translateX(0)";
    } else {
        // Em telas menores que 768px, esconder a sidebar
        sidebar.style.transform = "translateX(-100%)";
        if (!closeWasClicl){
            openBtn.style.visibility = "visible"
            closeBtn.style.visibility = "hidden"
        }
    }
});
document.addEventListener("DOMContentLoaded", async () => {
    const sidebar = document.getElementById("sidebar");
    const userId = sidebar.dataset.userId; // Obtém o ID do usuário do atributo data-user-id
    const baseURL = sidebar.dataset.baseUrl;
    //console.log(baseURL);
    

    if (userId) {
        try {
            const response = await fetch(baseURL+`/controller/UsuarioController.php?action=returnImage&userid=${userId}`);
            const data = await response.json();

            if (data.success) {
                const userImage = document.querySelector(".user-image");
                if (userImage) {
                    userImage.src = `${data.imagePath}`; // Atualiza o caminho da imagem
                }
            } else {
                console.error("Erro ao buscar imagem:", data.message);
            }
        } catch (error) {
            console.error("Erro na requisição:", error);
        }
    }
});
