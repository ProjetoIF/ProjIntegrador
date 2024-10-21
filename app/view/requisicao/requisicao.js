document.addEventListener('DOMContentLoaded', function () {
    var exampleModal = document.getElementById('exampleModal');
    var submitButton = document.getElementById('submit');

    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var nome = button.getAttribute('data-nome');
        var unidade = button.getAttribute('data-unidade');
        var descricao = button.getAttribute('data-descricao');
        var imagem = button.getAttribute('data-imagem');
        var ingredienteId = button.getAttribute('data-id-ingrediente');
        var requisicaoId = button.getAttribute('data-id-requisicao');

        var modalTitle = exampleModal.querySelector('.modal-title');
        var modalBody = exampleModal.querySelector('.modal-body');

        modalTitle.textContent = nome;
        modalBody.innerHTML = `
            <img src="${imagem}" class="img-fluid mb-3" alt="${nome}">
            <h5>Unidade de Medida: ${unidade}</h5>
            <p>${descricao}</p>
            <input type="number" id="quantidade-input" placeholder="${unidade}">
            <input type="hidden" id="ingrediente-id" value="${ingredienteId}">
            <input type="hidden" id="requisicao-id" value="${requisicaoId}">
        `;
    });

    submitButton.addEventListener('click', function () {
        var quantidade = document.getElementById('quantidade-input').value;
        var ingredienteId = document.getElementById('ingrediente-id').value;
        var requisicaoId = document.getElementById('requisicao-id').value;

        if (quantidade === "") {
            alert("Por favor, insira uma quantidade.");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/ProjIntegrador/app/controller/RequisicoesController.php?action=saveIngredientes", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                //alert("Ingrediente salvo com sucesso!");
                exampleModal.querySelector('.btn-close').click();
                recuperarIngredientes(requisicaoId); // Atualizar lista de ingredientes após salvar
            }
        };

        xhr.send("idRequisicao=" + requisicaoId + "&idIngrediente=" + ingredienteId + "&quantidade=" + quantidade);
    });
});

function recuperarIngredientes(requisicaoId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/ProjIntegrador/app/controller/RequisicoesController.php?action=listJsonSelectedIngredientes&id=" + requisicaoId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var ingredientes = JSON.parse(xhr.responseText);
            var ingredientsList = document.querySelector('.ingredients-list');
            
            // Limpar a lista atual
            ingredientsList.innerHTML = "";

            // Adicionar ingredientes atualizados
            ingredientes.forEach(function (ingrediente) {
                var listItem = document.createElement('li');
                listItem.innerHTML = `<span>${ingrediente.NomeIngrediente}</span> <span>${ingrediente.quantidade} ${ingrediente.UnidadeIngrediente}</span>`;
                ingredientsList.appendChild(listItem);
            });
        }
    };
    xhr.send();
}
