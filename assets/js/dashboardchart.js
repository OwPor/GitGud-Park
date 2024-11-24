const ctx = document.getElementById('stallPerformanceChart').getContext('2d');
const stallPerformanceChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Stall 1', 'Stall 2', 'Stall 3', 'Stall 4', 'Stall 5', 'Stall 6', 'Stall 7', 'Stall 8', 'Stall 9', 'Stall 10'],
    datasets: [{
      label: 'Performance (%)',
      data: [85, 70, 90, 60, 75, 95, 80, 50, 65, 88], // Example percentages
      backgroundColor: '#CD5C08',
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        max: 100,
        title: {
          display: true,
          text: 'Performance (%)'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Stalls'
        }
      }
    },
    plugins: {
      legend: {
        display: true,
        position: 'top'
      }
    }
  }
});

const ctxctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctxctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Months or dates
        datasets: [{
            label: 'Sales ($)',
            data: [1200, 1500, 1100, 1800, 2000, 1700], // Sales data
            borderColor: '#CD5C08',
            backgroundColor: 'rgba(205, 92, 8, 0.2)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Sales ($)'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Months'
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    }
});