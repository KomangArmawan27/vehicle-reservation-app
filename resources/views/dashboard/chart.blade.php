<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Reservation Report</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-4">

        {{-- Export Form --}}
        <form method="GET" action="{{ route('admin.export') }}" class="mb-6 flex flex-wrap items-center gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input 
                    type="date" 
                    name="start_date" 
                    id="start_date" 
                    required 
                    class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input 
                    type="date" 
                    name="end_date" 
                    id="end_date" 
                    required 
                    class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <div class="mt-6 sm:mt-8">
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition"
                >
                    Export Excel
                </button>
            </div>
        </form>

        {{-- Chart --}}
        <div>
            <canvas id="usageChart" style="width: 100%; height: 400px;"></canvas>
        </div>

    </div>

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
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
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
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });
    </script>
</x-app-layout>
