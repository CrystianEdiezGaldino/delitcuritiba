document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Frequência
    const ctx = document.getElementById('frequencyChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Frequência',
                data: [85, 78, 90, 88, 92, 89],
                borderColor: '#960018',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(150, 0, 24, 0.1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });

    // Mini Calendário
    new FullCalendar.Calendar(document.getElementById('miniCalendar'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        },
        events: [
            {
                title: 'Reunião Mensal',
                start: '2023-12-15',
                color: '#960018'
            },
            {
                title: 'Festividade',
                start: '2023-12-20',
                color: '#54595F'
            }
        ],
        height: 'auto'
    }).render();
});
