<?php
    include_once 'links.php'; 
?>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-matrix"></script>
<canvas id="visitsChart" class="w-100 h-100"></canvas>
<script>
const ctx = document.getElementById('visitsChart').getContext('2d');
new Chart(ctx, {
    type: 'matrix',
    data: {
        datasets: [{
            label: 'Visits by Hour',
            data: [
                { x: 0, y: 'Monday', v: 200 },
                { x: 1, y: 'Monday', v: 300 },
                { x: 0, y: 'Tuesday', v: 400 },
                // Add more data points
            ],
            backgroundColor: function(context) {
                const value = context.dataset.data[context.dataIndex].v;
                return value > 300 ? '#CD5C08' : '#FFBD33';
            },
            width: function(context) {
                return context.chart.width / 24; // Divide by 24 for hours
            },
            height: function(context) {
                return context.chart.height / 7; // Divide by 7 for days
            }
        }]
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                position: 'bottom',
                ticks: {
                    callback: function(value) {
                        return value + ':00'; // Hour labels
                    }
                }
            },
            y: {
                type: 'category',
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
            }
        }
    }
});
</script>
