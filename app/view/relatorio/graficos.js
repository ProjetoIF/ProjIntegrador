
const dataAtual = new Date()

function generateColors(numColors) {
  const colors = [];
  const baseColors = [
      '255, 99, 132', '255, 159, 64', '255, 205, 86', '75, 192, 192',
      '54, 162, 235', '153, 102, 255', '201, 203, 207', '100, 200, 255',
      '200, 150, 100', '255, 255, 100', '180, 255, 100', '100, 180, 255'
  ];

  for (let i = 0; i < numColors; i++) {
      const color = baseColors[i % baseColors.length]; // Repeats colors if needed
      const rgbaColor = `rgba(${color})`; // Adiciona transparência
      const rgbColor = `rgb(${color})`; // Cor sem transparência
      colors.push({ backgroundColor: rgbaColor, borderColor: rgbColor });
  }

  return colors;
}

const donutChartColorsIngredientes = generateColors(Object.keys(donutChartDadosIngredientes).length);

const ctx = document.getElementById('donut-chart').getContext('2d');
const donutChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: Object.keys(donutChartDadosIngredientes),
    datasets: [{
      data: Object.values(donutChartDadosIngredientes), // Dados para o gráfico
      backgroundColor: donutChartColorsIngredientes.map(c => c.backgroundColor),
      hoverOffset: 4 // Destaque ao passar o mouse
    }]
  },
  options: {
    plugins: {
      title: {
        display: true,
        text: 'Total de ingredientes já requisitados'
      }
    }
  }
});

const graphBarMes = document.getElementById('chartMes').getContext('2d');

const labelsBarChartMes = [];
const arrDataBarChartMes = [];

Object.values(barChartDadosMes).forEach(item => {
  labelsBarChartMes.push(item.nome);
  arrDataBarChartMes.push(item.count);
});

const barChartColorsMes = generateColors(12);

const barChartMes = new Chart(graphBarMes, {
  type: 'bar',
  data: {
    labels: labelsBarChartMes,
    datasets: [{
      label: 'Requisições por mês',
      data: arrDataBarChartMes,
      backgroundColor: barChartColorsMes.map(c => c.backgroundColor),
      borderColor: barChartColorsMes.map(c => c.borderColor),
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    plugins: {
      title: {
        display: true,
        text: `Quantidade de requisições por mês no ano de ${dataAtual.getFullYear()}`
      }
    }
  },
});

const graphBarTurma = document.getElementById('chartTurma').getContext('2d');

const labelsBarChartTurma = [];
const arrDataBarChartTurma = [];

Object.entries(barChartDadosTurmas).forEach(([turma, quantidade]) => {
  labelsBarChartTurma.push(turma);
  arrDataBarChartTurma.push(quantidade);
});

const barChartColorsTurma = generateColors(labelsBarChartTurma.length);

const barChart = new Chart(graphBarTurma, {
  type: 'bar',
  data: {
    labels: labelsBarChartTurma,
    datasets: [{
      label: 'Requisições por Turmas',
      data: arrDataBarChartTurma,
      backgroundColor: barChartColorsTurma.map(c => c.backgroundColor),
      borderColor: barChartColorsTurma.map(c => c.borderColor),
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    plugins: {
      title: {
        display: true,
        text: `Quantidade de requisições por turma no ano de ${dataAtual.getFullYear()}`
      }
    }
  },
});