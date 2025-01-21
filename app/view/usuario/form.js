// Função que esconde ou mostra os campos de senha e alerta
function togglePasswordFields() {
    var senhaGroup = document.getElementById('senhaGroup');
    var confSenhaGroup = document.getElementById('confSenhaGroup');
    var alerta = document.getElementById('alertaAlterarSenha');
    var alterarSenhaSim = document.getElementById('alterarSenha').checked;

    if (alterarSenhaSim) {
        // Mostra os campos de senha e o alerta
        senhaGroup.style.display = 'block';
        confSenhaGroup.style.display = 'block';
        alerta.style.display = 'block';
    } else {
        // Esconde os campos de senha e o alerta
        senhaGroup.style.display = 'none';
        confSenhaGroup.style.display = 'none';
        alerta.style.display = 'none';
    }
}

// Adiciona os eventos de mudança para os radio buttons
document.getElementById('alterarSenha').addEventListener('change', togglePasswordFields);
document.getElementById('alterarSenhaNo').addEventListener('change', togglePasswordFields);

// Chama a função ao carregar a página para ajustar o estado inicial
window.onload = togglePasswordFields;