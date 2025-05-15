<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            @if (auth()->user()->role === 'admin')
                All Reservations
            @elseif (auth()->user()->role === 'approver')
                Reservations for Approval
            @else
                My Reservations
            @endif
        </h2>
    </x-slot>

    <div class="p-6">
        @if (auth()->user()->role === 'admin')
            {{-- Admin sees all reservation statuses --}}
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Vehicle</th>
                        <th class="border px-4 py-2">Driver</th>
                        <th class="border px-4 py-2">Start Time</th>
                        <th class="border px-4 py-2">End Time</th>
                        <th class="border px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="border px-4 py-2">{{ $reservation->user->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $reservation->vehicle->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $reservation->driver->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $reservation->start_time }}</td>
                            <td class="border px-4 py-2">{{ $reservation->end_time }}</td>
                            <td class="border px-4 py-2 capitalize">{{ $reservation->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @elseif (auth()->user()->role === 'approver')
            {{-- Approver sees only reservations needing their review --}}
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Vehicle</th>
                        <th class="border px-4 py-2">Start Time</th>
                        <th class="border px-4 py-2">End Time</th>
                        <th class="border px-4 py-2">Level</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingApprovals as $approval)
                        <tr>
                            <td class="border px-4 py-2">{{ $approval->reservation->user->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $approval->reservation->vehicle->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $approval->reservation->start_time }}</td>
                            <td class="border px-4 py-2">{{ $approval->reservation->end_time }}</td>
                            <td class="border px-4 py-2">{{ $approval->level }}</td>
                            <td class="border px-4 py-2">
                                {{-- Example actions --}}
                                <form method="POST" action="{{ route('approvals.update', $approval->id) }}">
                                    @csrf
                                    @method('put')
                                    <button name="status" value="approved" class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                                    <button name="status" value="rejected" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @else
            {{-- Regular users see their own reservations --}}
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Vehicle</th>
                        <th class="border px-4 py-2">Start Time</th>
                        <th class="border px-4 py-2">End Time</th>
                        <th class="border px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="border px-4 py-2">{{ $reservation->vehicle->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $reservation->start_time }}</td>
                            <td class="border px-4 py-2">{{ $reservation->end_time }}</td>
                            <td class="border px-4 py-2 capitalize">{{ $reservation->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
