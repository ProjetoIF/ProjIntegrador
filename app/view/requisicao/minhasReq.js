const baseURL = document.getElementById("baseurl").value

console.log(baseURL);

document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".cardReq");

    cards.forEach(card => {
        card.addEventListener("click", function () {
            const requisicaoId = card.dataset.id;
            const status = card.dataset.status;
            const motivoDevolucao = card.dataset.motivo;

            // Faz a requisição para obter os ingredientes
            fetch(`${baseURL}/controller/RequisicoesController.php?action=listJsonSelectedIngredientes&id=${requisicaoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro ao carregar os ingredientes.");
                    }
                    return response.json();
                })
                .then(data => {
                    // Prepara a lista de ingredientes para exibição
                    let ingredientesHtml = `
                        <h5 class="text-primary">Ingredientes da Requisição:</h5>
                        <ul class="list-group mb-3">`;
                    data.forEach(ingrediente => {
                        ingredientesHtml += `
                            <li class="list-group-item">
                                <strong>${ingrediente.NomeIngrediente}</strong>:
                                ${ingrediente.quantidade} ${ingrediente.UnidadeIngrediente}
                            </li>`;
                    });
                    ingredientesHtml += "</ul>";

                    let modalContent = ingredientesHtml;

                    // Adiciona o motivo da devolução e o formulário se for rejeitado
                    if (status === "REJEITADO") {
                        const motivoHtml = `
                            <h5 class="text-danger">Motivo da Rejeição:</h5>
                            <p class="alert alert-danger">
                                ${motivoDevolucao || "Motivo não informado."}
                            </p>`;

                        const formHtml = `
                            <form action="${baseURL}/controller/RequisicoesController.php?action=updateReqStatus" method="post"
                                onsubmit="return confirm('Tem certeza de que deseja alterar o status para preenchimento?');">
                                <div class="buttons mt-3">
                                    <button id="send" class="btn btn-warning">Alterar para Preenchimento</button>
                                </div>
                                <input type="hidden" name="id" value="${requisicaoId}">
                                <input type="hidden" name="status" value="PREENCHIMENTO">
                            </form>`;

                        modalContent = motivoHtml + ingredientesHtml + formHtml;
                    }

                    // Exibe o conteúdo no modal
                    document.getElementById("modalTitle").innerText = 
                        status === "REJEITADO" ? "Detalhes da Rejeição" : "Ingredientes da Requisição";
                    document.getElementById("modalBody").innerHTML = modalContent;

                    new bootstrap.Modal(document.getElementById("infoModal")).show();
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById("modalTitle").innerText = "Erro";
                    document.getElementById("modalBody").innerHTML = `<p class="text-danger">Não foi possível carregar os ingredientes.</p>`;
                    new bootstrap.Modal(document.getElementById("infoModal")).show();
                });
        });
    });
});
