<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Klasemen Liga</h2>

    @if(count($standings))
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2 text-left">Tim</th>
                    <th class="border px-4 py-2">Main</th>
                    <th class="border px-4 py-2">Menang</th>
                    <th class="border px-4 py-2">Seri</th>
                    <th class="border px-4 py-2">Kalah</th>
                    <th class="border px-4 py-2">GM</th>
                    <th class="border px-4 py-2">GK</th>
                    <th class="border px-4 py-2">SG</th>
                    <th class="border px-4 py-2">Poin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($standings as $index => $team)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2 text-left">{{ $team['name'] }}</td>
                        <td class="border px-4 py-2">{{ $team['played'] }}</td>
                        <td class="border px-4 py-2">{{ $team['win'] }}</td>
                        <td class="border px-4 py-2">{{ $team['draw'] }}</td>
                        <td class="border px-4 py-2">{{ $team['loss'] }}</td>
                        <td class="border px-4 py-2">{{ $team['goalsfor'] }}</td>
                        <td class="border px-4 py-2">{{ $team['goalsagainst'] }}</td>
                        <td class="border px-4 py-2">{{ $team['goalsdifference'] }}</td>
                        <td class="border px-4 py-2 font-bold">{{ $team['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-red-500">Data klasemen tidak tersedia untuk liga ini.</p>
    @endif
</div>
