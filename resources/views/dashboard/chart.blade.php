<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Admin Dashboard</h2>
    </x-slot>

    <div class="p-6">
        <canvas id="usageChart"></canvas>
    </div>

    <form method="GET" action="{{ route('admin.export') }}" class="mb-4">
        <label>Start Date: <input type="date" name="start_date" required></label>
        <label>End Date: <input type="date" name="end_date" required></label>
        <button type="submit" class="btn btn-primary">Export Excel</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('usageChart').getContext('2d');
        const usageChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($usageStats->pluck('date')) !!},
                datasets: [{
                    label: 'Total Reservations',
                    data: {!! json_encode($usageStats->pluck('count')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
</x-app-layout>
