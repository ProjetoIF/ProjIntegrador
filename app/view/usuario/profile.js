// Função para editar o campo de usuário (login, email, telefone)
function editarCampo(campo) {
    const valorAtual = document.getElementById(campo).textContent;
    const input = document.createElement("input");
    input.type = "text";
    input.classList.add("form-control");
    input.value = valorAtual;

    const span = document.getElementById(campo);
    span.innerHTML = "";
    span.appendChild(input);

    const btn = document.querySelector(`button[onclick="editarCampo('${campo}')"]`);
    btn.textContent = "Salvar";
    btn.setAttribute("onclick", `salvarAlteracoes('${campo}')`);
}

// Função para salvar alterações (exclusivo para login, email, telefone, via AJAX)
function salvarAlteracoes(campo) {
    const novoValor = document.getElementById(campo).querySelector("input").value;
    const userId = document.getElementById("userId").value; // Recupera o ID do usuário (se necessário)

    if (campo === "login") {
        // Envia a requisição AJAX para atualizar o login
        atualizarLogin(novoValor, userId);
    } else if (campo === "email") {
        // Envia a requisição AJAX para atualizar o email
        atualizarEmail(novoValor, userId);
    } else if (campo === "telefone") {
        // Envia a requisição AJAX para atualizar o telefone
        atualizarTelefone(novoValor, userId);
    } else {
        // Para outros campos, apenas atualiza a interface
        document.getElementById(campo).textContent = novoValor;
    }

    const btn = document.querySelector(`button[onclick="salvarAlteracoes('${campo}')"]`);
    btn.textContent = "Alterar";
    btn.setAttribute("onclick", `editarCampo('${campo}')`);
}

// Função para atualizar o login via AJAX
function atualizarLogin(novoLogin, userId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `http://localhost/ProjIntegrador/app/controller/UsuarioController.php?action=editLogin&newLogin=${novoLogin}&userId=${userId}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Se a requisição for bem-sucedida, atualiza o login na interface
            document.getElementById("login").textContent = novoLogin;
            exibirAlertaSucesso("Login atualizado com sucesso!");
        } else {
            // Caso ocorra algum erro, podemos exibir uma mensagem de erro
            alert("Erro ao atualizar o login. Tente novamente.");
        }
    };

    xhr.onerror = function () {
        alert("Erro de comunicação com o servidor. Tente novamente.");
    };

    xhr.send();
}

// Função para atualizar o email via AJAX
function atualizarEmail(novoEmail, userId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `http://localhost/ProjIntegrador/app/controller/UsuarioController.php?action=editEmail&newEmail=${novoEmail}&userId=${userId}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Se a requisição for bem-sucedida, atualiza o email na interface
            document.getElementById("email").textContent = novoEmail;
            exibirAlertaSucesso("Email atualizado com sucesso!");
        } else {
            // Caso ocorra algum erro, podemos exibir uma mensagem de erro
            alert("Erro ao atualizar o e-mail. Tente novamente.");
        }
    };

    xhr.onerror = function () {
        alert("Erro de comunicação com o servidor. Tente novamente.");
    };

    xhr.send();
}

// Função para atualizar o telefone via AJAX
function atualizarTelefone(novoTelefone, userId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `http://localhost/ProjIntegrador/app/controller/UsuarioController.php?action=editTelefone&newTelefone=${novoTelefone}&userId=${userId}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Se a requisição for bem-sucedida, atualiza o telefone na interface
            document.getElementById("telefone").textContent = novoTelefone;
            exibirAlertaSucesso("Telefone atualizado com sucesso!");
        } else {
            // Caso ocorra algum erro, podemos exibir uma mensagem de erro
            alert("Erro ao atualizar o telefone. Tente novamente.");
        }
    };

    xhr.onerror = function () {
        alert("Erro de comunicação com o servidor. Tente novamente.");
    };

    xhr.send();
}

function atualizarSenha(novaSenha, userId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `http://localhost/ProjIntegrador/app/controller/UsuarioController.php?action=editSenha&newSenha=${novaSenha}&userId=${userId}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Se a requisição for bem-sucedida, exibe uma mensagem de sucesso
            exibirAlertaSucesso("Senha atualizada com sucesso!");
        } else {
            // Caso ocorra algum erro, podemos exibir uma mensagem de erro
            alert("Erro ao atualizar a senha. Tente novamente.");
        }
    };

    xhr.onerror = function () {
        alert("Erro de comunicação com o servidor. Tente novamente.");
    };

    xhr.send();
}

// Função para editar senha
function editarSenha() {
    document.getElementById("nova-senha-div").style.display = "block";
    document.getElementById("confirmar-senha-div").style.display = "block";
    document.getElementById("salvar-senha-btn").style.display = "inline-block";
    document.querySelector('button[onclick="editarSenha()"]').style.display = "none";
}

// Função para salvar a senha
function salvarSenha() {
    const novaSenha = document.getElementById("nova-senha").value;
    const confirmarSenha = document.getElementById("confirmar-senha").value;

    if (novaSenha === confirmarSenha) {

        atualizarSenha(novaSenha, userId.value);

        document.getElementById("nova-senha").value = "";
        document.getElementById("confirmar-senha").value = "";

        document.getElementById("senha").textContent = "**********";

        document.getElementById("nova-senha-div").style.display = "none";
        document.getElementById("confirmar-senha-div").style.display = "none";
        document.getElementById("salvar-senha-btn").style.display = "none";



        document.querySelector('button[onclick="editarSenha()"]').style.display = "inline-block";

        // Limpar qualquer alerta de erro, caso tenha sido exibido anteriormente
        const alerta = document.getElementById("alerta");
        if (alerta) {
            alerta.remove();
        }
    } else {
        // Exibe um alerta Bootstrap se as senhas não coincidirem
        exibirAlerta("As senhas não coincidem. Tente novamente.");
    }
}

// Função para alternar visibilidade da senha
function toggleSenha(id) {
    var senhaInput = document.getElementById(id);
    var tipo = senhaInput.type === "password" ? "text" : "password";
    senhaInput.type = tipo;

    var icon = document.getElementById("toggle-" + id).querySelector("i");
    if (tipo === "password") {
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}

// Função para exibir um alerta Bootstrap
function exibirAlerta(mensagem) {
    // Verifica se já existe um alerta, se sim, remove
    const alertaExistente = document.getElementById("alerta");
    if (alertaExistente) {
        alertaExistente.remove();
    }

    // Cria o novo alerta
    const alerta = document.createElement("div");
    alerta.classList.add("alert", "alert-danger", "alert-dismissible", "fade", "show", "mt-2");
    alerta.setAttribute("role", "alert");
    alerta.id = "alerta"; // Adicionando um id para facilitar a remoção
    alerta.innerHTML = mensagem;

    // Adiciona o alerta logo abaixo do botão "Salvar Senha"
    const salvarBtn = document.getElementById("salvar-senha-btn");
    salvarBtn.insertAdjacentElement("afterend", alerta);
}

// Função para exibir um alerta de sucesso do Bootstrap
function exibirAlertaSucesso(mensagem) {
    // Verifica se já existe um alerta, se sim, remove
    const alertaExistente = document.getElementById("alerta");
    if (alertaExistente) {
        alertaExistente.remove();
    }

    // Cria o novo alerta de sucesso
    const alerta = document.createElement("div");
    alerta.classList.add("alert", "alert-success", "alert-dismissible", "fade", "show", "mt-2");
    alerta.setAttribute("role", "alert");
    alerta.id = "alerta"; // Adicionando um id para facilitar a remoção
    alerta.innerHTML = mensagem;

    // Adiciona o alerta logo abaixo do botão "Salvar Senha"
    const salvarBtn = document.getElementById("salvar-senha-btn");
    salvarBtn.insertAdjacentElement("afterend", alerta);

    // Remove o alerta após 5 segundos
    setTimeout(() => {
        alerta.remove();
    }, 5000); // Alerta desaparece após 5 segundos
}


