document.getElementById('print').addEventListener('click', function(event) {
    event.preventDefault();

    // Criar o conteúdo da impressão
    let printWindow = window.open('', '', 'width=800,height=600');
    let content = '<html><head><title>Requisição geral</title>';
    content += '<style>body{font-family: Arial, sans-serif; font-size: 14px;} table{width: 100%; border-collapse: collapse;} table, th, td{border: 1px solid black;} th, td{padding: 8px; text-align: left;} footer{position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 12px;} table + table {margin-top: 20px;}</style>';
    content += '</head><body>';
    
    // Adicionar o título "Requisições"
    content += '<h1>Requisições</h1>';
    
    // Adicionar as tabelas de requisições individuais
    const requisicoesTables = document.querySelectorAll('.table-striped');  // Selecionando todas as tabelas
    requisicoesTables.forEach(function(table) {
        if (table.querySelector('th[colspan="4"]')) {
            content += table.outerHTML;
        }
    });

    // Adicionar o título "Requisição geral"
    content += '<h2>Requisição geral</h2>';
    
    // Adicionar a tabela da requisição geral
    const geralTables = document.querySelectorAll('table');
    geralTables.forEach(function(table) {
        if (!table.querySelector('th[colspan="4"]')) {
            content += table.outerHTML;
        }
    });

    // Adicionar o rodapé
    let currentDate = new Date();
    let footerText = 'Essa requisição foi gerada no ChefTrack as ' + currentDate.toLocaleString();
    content += `<footer>${footerText}</footer>`;
    
    // Fechar a tag de body e html
    content += '</body></html>';

    // Escrever o conteúdo no documento de impressão
    printWindow.document.open();
    printWindow.document.write(content);
    printWindow.document.close();

    // Iniciar a impressão
    printWindow.print();
    printWindow.close();
});
