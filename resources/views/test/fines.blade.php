<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Fines Testing Page</h2>

        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Current Fine Settings</h3>
            @if($settings)
                <p>Fine Amount: ₱{{ number_format($settings->fine_amount, 2) }}</p>
                <p>Morning Check-in: {{ $settings->morning_checkin ? 'Required' : 'Not Required' }}</p>
                <p>Morning Check-out: {{ $settings->morning_checkout ? 'Required' : 'Not Required' }}</p>
                <p>Afternoon Check-in: {{ $settings->afternoon_checkin ? 'Required' : 'Not Required' }}</p>
                <p>Afternoon Check-out: {{ $settings->afternoon_checkout ? 'Required' : 'Not Required' }}</p>
            @else
                <p>No settings found</p>
            @endif
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">Current Fines</h3>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="border p-2">Student</th>
                        <th class="border p-2">Event</th>
                        <th class="border p-2">Absences</th>
                        <th class="border p-2">Total Fines</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fines as $fine)
                        <tr>
                            <td class="border p-2">{{ $fine->student->s_fname }} {{ $fine->student->s_lname }}</td>
                            <td class="border p-2">{{ $fine->event->event_name }}</td>
                            <td class="border p-2">{{ $fine->absences }}</td>
                            <td class="border p-2">₱{{ number_format($fine->total_fines, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border p-2 text-center">No fines recorded</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
