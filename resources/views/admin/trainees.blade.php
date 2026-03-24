@extends('admin.layout')
@section('title', 'Trainees')

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="playfair text-3xl font-bold text-[#0f2744]">Trainees</h1>
        <p class="text-gray-500 mt-1">All registered trainees and their affiliated hospitals</p>
    </div>
    <a href="{{ route('admin.trainees.export') }}"
        class="flex items-center gap-2 bg-[#0f2744] text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-[#1a3a5c] transition">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Trainee</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">PEN</th>
                <th class="px-6 py-3 text-left">Gender</th>
                <th class="px-6 py-3 text-left">Nationality</th>
                <th class="px-6 py-3 text-left">Hospital(s)</th>
                <th class="px-6 py-3 text-left">Programme(s)</th>
                <th class="px-6 py-3 text-left">Trainer(s)</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($trainees as $trainee)
            @php
                $hospitals = $trainee->trainers->pluck('hospital.name')->filter()->unique();
                $programmes = $trainee->trainers->pluck('program.name')->filter()->unique();
                $trainerNames = $trainee->trainers->pluck('name');
            @endphp
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-[#0f2744]">{{ $trainee->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $trainee->email }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $trainee->pen ?: '—' }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $trainee->gender ?: '—' }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $trainee->nationality ?: '—' }}</td>
                <td class="px-6 py-4 text-gray-600">
                    @forelse($hospitals as $hospital)
                        <span class="inline-block bg-blue-50 text-blue-700 border border-blue-100 text-xs font-medium px-2 py-0.5 rounded mr-1 mb-1">{{ $hospital }}</span>
                    @empty
                        <span class="text-gray-400">—</span>
                    @endforelse
                </td>
                <td class="px-6 py-4 text-gray-600">
                    @forelse($programmes as $programme)
                        <span class="inline-block bg-yellow-50 text-yellow-700 border border-yellow-100 text-xs font-medium px-2 py-0.5 rounded mr-1 mb-1">{{ $programme }}</span>
                    @empty
                        <span class="text-gray-400">—</span>
                    @endforelse
                </td>
                <td class="px-6 py-4 text-gray-500 text-xs">
                    {{ $trainerNames->implode(', ') ?: '—' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-400">No trainees found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $trainees->links() }}
    </div>
</div>

@endsection
