
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
        console.log(closeWasClicl)
    });

    closeBtn.addEventListener('click', function() {
        sidebar.style.transform = "translateX(-100%)";
        openBtn.style.visibility = "visible"
        closeBtn.style.visibility = "hidden"
        closeWasClicl = true
        console.log(closeWasClicl)
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