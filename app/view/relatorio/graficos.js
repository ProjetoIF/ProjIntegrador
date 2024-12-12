const ctx = document.getElementById('donut-chart').getContext('2d');
const donutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Blue', 'Orange', 'Green'], // Rótulos das categorias
        datasets: [{
            data: [2, 4, 3], // Dados para o gráfico
            backgroundColor: [
                'blue',
                'orange',
                'green'
            ],
            hoverOffset: 4 // Destaque ao passar o mouse
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Exemplo de Gráfico Donut'
            }
        }
    }
});

const graphBar = document.getElementById('bar-chart').getContext('2d');
const barChart = new Chart(graphBar, {
    type: 'bar',
    data : {
        labels: ["janeiro","janeiro","janeiro","janeiro","janeiro","janeiro","janeiro"],
        datasets: [{
          label: 'My First Dataset',
          data: [10, 20, 30, 40, 50, 60, 70],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
});