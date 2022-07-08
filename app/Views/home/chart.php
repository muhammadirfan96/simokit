<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div>
                <canvas id="chartBar" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/chart/chart.js"></script>

<script>
    const ctx = document.getElementById('chartBar');
    const labels = [
        'CEP A', 'CEP B', 'BFP A', 'BFP B', 'BFP C', 'CCWP A', 'CCWP B', 'CWP C', 'CWP D', 'IDF A', 'IDF B', 'SAF A', 'SAF B', 'PAF A', 'PAF B', 'VACUUM P A', 'VACUUM P B', 'HPFF A', 'HPFF B', 'HPFF C', 'EH OIL P A', 'EH OIL P B'
    ]
    const data = [
        4175.25, 6368.31, 7764.51, 4267.23, 6785.73, 2558.03, 2418.97, 10360.02, 11852.78, 10841.74, 10990.90, 9076.35, 8186.36, 12334.10, 12313.50, 281905.737, 470.50, 975.80, 1.0411, 34413.267, 24798.222
    ]

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'power meter (kwh)',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)'
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
        }
    });
</script>