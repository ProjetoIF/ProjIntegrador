const baseURL = document.getElementById("baseurl").value

document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os cards de requisição
    const cards = document.querySelectorAll('.cardReq');
    
    // Quando um card for clicado
    cards.forEach(card => {
        card.addEventListener('click', function() {
            const requisicaoId = card.getAttribute('data-id');
            const NomeTurma = card.getAttribute('data-turma');
            const NomeDisciplina = card.getAttribute('data-disciplina');
            const DataRequisicao = card.getAttribute('data-req');
            const NomeProfessor= card.getAttribute('data-prof');
            const ContDesc= card.getAttribute('data-desc');
            
            // Faz uma requisição AJAX para pegar os ingredientes dessa requisição
            fetch(baseURL+`/controller/RequisicoesController.php?action=listJsonSelectedIngredientes&id=${requisicaoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na requisição');
                    }
                    return response.json();
                })
                .then(data => {
                    // Verifica se o modal existe
                    const ingredientesTableBody = document.getElementById('ingredientesTableBody');
                    const dataRequisicao = document.getElementById('dataReq');
                    const nomeTurma = document.getElementById('nomeTurma');
                    const nomeDisciplinaElement = document.getElementById('nomeDisciplinaElement');
                    const nomeProfessor = document.getElementById('nomeProfessorId');
                    const txtDescricao = document.getElementById('descricaoId');
                    const idReq = document.getElementById('idReq');

                    if (!ingredientesTableBody || !dataRequisicao || !nomeTurma || !nomeDisciplinaElement ||
                         !nomeProfessor || !txtDescricao || !idReq) {
                        console.error('Elemento(s) não encontrado');
                        return;
                    }

                    ingredientesTableBody.innerHTML = ''; // Limpa a tabela atual

                    // Preenche os campos do modal com as informações de turma e disciplina
                    dataRequisicao.textContent = DataRequisicao;
                    nomeTurma.textContent = NomeTurma;       // Nome da turma
                    nomeDisciplinaElement.textContent = NomeDisciplina;  // Nome da disciplina
                    nomeProfessor.textContent = NomeProfessor;
                    txtDescricao.textContent = ContDesc;
                    idReq.value = requisicaoId;

                    if (data.length > 0) {
                        // Preenche o modal com os ingredientes
                        data.forEach(ingrediente => {
                            const row = document.createElement('tr');
                            
                            const nomeIngredienteCell = document.createElement('td');
                            nomeIngredienteCell.textContent = ingrediente.NomeIngrediente;
                            row.appendChild(nomeIngredienteCell);
                            
                            const quantidadeCell = document.createElement('td');
                            quantidadeCell.textContent = ingrediente.quantidade;
                            row.appendChild(quantidadeCell);

                            const unidadeCell = document.createElement('td');
                            unidadeCell.textContent = ingrediente.UnidadeIngrediente;
                            row.appendChild(unidadeCell);

                            ingredientesTableBody.appendChild(row);
                        });
                    } else {
                        // Caso não haja ingredientes
                        const row = document.createElement('tr');
                        const cell = document.createElement('td');
                        cell.colSpan = 3;
                        cell.textContent = 'Nenhum ingrediente cadastrado.';
                        row.appendChild(cell);
                        ingredientesTableBody.appendChild(row);
                    }

                    // Abre o modal
                    const modalElement = document.getElementById('modalIngredientes');
                    if (modalElement) {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    } else {
                        console.error('Modal não encontrado');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar os ingredientes:', error);
                    // Exibe uma mensagem para o usuário (pode ser feito via UI)
                    alert('Ocorreu um erro ao carregar os ingredientes. Tente novamente.');
                });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o botão de rejeitar e o campo de motivo
    const btnRejeitar = document.getElementById('btnRejeitar');
    const motivoRejeicao = document.getElementById('motivoRejeicao');
    const btnSubmitRejeitar = document.getElementById('btnSubmitRejeitar');
    const idReqReject = document.getElementById('idReqReject');

    // Mostra o campo de motivo e o botão de confirmação ao clicar em "Rejeitar"
    btnRejeitar.addEventListener('click', function() {
        motivoRejeicao.classList.remove('d-none');
        btnSubmitRejeitar.classList.remove('d-none');
        btnRejeitar.classList.add('d-none');

        // Preenche o ID da requisição no formulário de rejeição
        const requisicaoId = document.getElementById('idReq').value;
        idReqReject.value = requisicaoId;
    });
});

