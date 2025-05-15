<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create Vehicle Reservation</h2>

        <form method="POST" action="{{ route('reservations.store') }}" class="bg-white p-6 rounded-lg shadow-md space-y-5">
            @csrf

            <!-- Vehicle Selection -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Vehicle</label>
                <select name="vehicle_id" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->license_plate }})</option>
                    @endforeach
                </select>
            </div>
            
            <!-- driver Selection -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Driver</label>
                <select name="driver_id" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }} ({{ $driver->license_number }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Start Time -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Start Time</label>
                <input type="datetime-local" name="start_time" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- End Time -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">End Time</label>
                <input type="datetime-local" name="end_time" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Purpose -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Purpose</label>
                <textarea name="purpose" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"></textarea>
            </div>

            <!-- Approver 1 -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Approver 1</label>
                <select name="approver_level_1" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach($approvers as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Approver 2 -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Approver 2</label>
                <select name="approver_level_2" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach($approvers as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Submit Reservation
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
