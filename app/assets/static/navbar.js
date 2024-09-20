document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('open-btn');
    const closeBtn = document.getElementById('close-btn');
    const sidebar = document.getElementById('sidebar');

    openBtn.addEventListener('click', function() {
        sidebar.style.transform = "translateX(0%)";
        openBtn.style.visibility = "hidden"
        closeBtn.style.visibility = "visible"
    });

    closeBtn.addEventListener('click', function() {
        sidebar.style.transform = "translateX(-100%)";
        openBtn.style.visibility = "visible"
        closeBtn.style.visibility = "hidden"
    });
});
window.addEventListener("resize", function() {
    if (window.innerWidth > 768) {
        // Em telas maiores que 768px, sempre mostrar a sidebar
        sidebar.style.transform = "translateX(0)";
    } else {
        // Em telas menores que 768px, esconder a sidebar
        sidebar.style.transform = "translateX(-100%)";
    }
});