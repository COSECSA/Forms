@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

<div class="mb-7">
    <h1 class="text-[22px] font-bold text-[#1a0a08] tracking-tight">Dashboard</h1>
    <p class="text-sm text-[#9e7b73] mt-1">Overview of all COSECSA programme submissions</p>
</div>

{{-- Stats --}}
<div class="grid grid-cols-4 gap-4 mb-8">
    <a href="{{ route('admin.submissions') }}"
        class="bg-white rounded-2xl p-5 block transition-all hover:-translate-y-0.5"
        style="box-shadow:0 2px 8px rgba(131,28,9,0.07),0 1px 2px rgba(131,28,9,0.05);">
        <div class="w-9 h-9 rounded-xl mb-3 flex items-center justify-center" style="background:#f5e0db;">
            <svg class="w-4 h-4 text-[#831C09]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div class="text-2xl font-bold text-[#831C09]">{{ $stats['total_submissions'] }}</div>
        <div class="text-xs font-medium text-[#9e7b73] mt-0.5 uppercase tracking-wide">Submissions</div>
    </a>

    <a href="{{ route('admin.hospitals') }}"
        class="bg-white rounded-2xl p-5 block transition-all hover:-translate-y-0.5"
        style="box-shadow:0 2px 8px rgba(131,28,9,0.07),0 1px 2px rgba(131,28,9,0.05);">
        <div class="w-9 h-9 rounded-xl mb-3 flex items-center justify-center" style="background:#fef8dc;">
            <svg class="w-4 h-4" style="color:#b08a00;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div class="text-2xl font-bold" style="color:#b08a00;">{{ $stats['total_hospitals'] }}</div>
        <div class="text-xs font-medium text-[#9e7b73] mt-0.5 uppercase tracking-wide">Hospitals</div>
    </a>

    <a href="{{ route('admin.trainers') }}"
        class="bg-white rounded-2xl p-5 block transition-all hover:-translate-y-0.5"
        style="box-shadow:0 2px 8px rgba(131,28,9,0.07),0 1px 2px rgba(131,28,9,0.05);">
        <div class="w-9 h-9 rounded-xl mb-3 flex items-center justify-center bg-[#edf7f1]">
            <svg class="w-4 h-4 text-[#1e7e4a]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <div class="text-2xl font-bold text-[#1e7e4a]">{{ $stats['total_trainers'] }}</div>
        <div class="text-xs font-medium text-[#9e7b73] mt-0.5 uppercase tracking-wide">Trainers</div>
    </a>

    <a href="{{ route('admin.trainees') }}"
        class="bg-white rounded-2xl p-5 block transition-all hover:-translate-y-0.5"
        style="box-shadow:0 2px 8px rgba(131,28,9,0.07),0 1px 2px rgba(131,28,9,0.05);">
        <div class="w-9 h-9 rounded-xl mb-3 flex items-center justify-center bg-[#e8f0fe]">
            <svg class="w-4 h-4 text-[#1a73e8]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m0 0a4 4 0 118 0m-8 0A4 4 0 019 12a4 4 0 014 4"/>
            </svg>
        </div>
        <div class="text-2xl font-bold text-[#1a73e8]">{{ $stats['total_trainees'] }}</div>
        <div class="text-xs font-medium text-[#9e7b73] mt-0.5 uppercase tracking-wide">Trainees</div>
    </a>
</div>

{{-- Recent Submissions --}}
<div class="bg-white rounded-2xl overflow-hidden" style="box-shadow:0 2px 8px rgba(131,28,9,0.07),0 1px 2px rgba(131,28,9,0.05);">
    <div class="px-6 py-4 flex items-center justify-between border-b border-[#f5ede9]">
        <h2 class="text-[14px] font-semibold text-[#1a0a08]">Recent Submissions</h2>
        <a href="{{ route('admin.submissions') }}"
            class="text-xs font-semibold text-[#831C09] hover:text-[#6e1707] transition-colors uppercase tracking-wide">
            View all →
        </a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-[#fdf8f6]">
                <th class="px-6 py-3 text-left text-[11px] font-semibold text-[#b08a83] uppercase tracking-wider">Director</th>
                <th class="px-6 py-3 text-left text-[11px] font-semibold text-[#b08a83] uppercase tracking-wider">Hospital</th>
                <th class="px-6 py-3 text-left text-[11px] font-semibold text-[#b08a83] uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-[11px] font-semibold text-[#b08a83] uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#faf1ee]">
            @forelse($recent as $submission)
            <tr class="hover:bg-[#fdf8f6] transition-colors">
                <td class="px-6 py-4 font-medium text-[#1a0a08]">{{ $submission->director_name }}</td>
                <td class="px-6 py-4 text-[#6b4a44]">{{ $submission->hospital->name ?? '—' }}</td>
                <td class="px-6 py-4 text-[#b08a83] text-[13px]">{{ $submission->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.submissions.show', $submission) }}"
                        class="text-[13px] font-semibold text-[#831C09] hover:text-[#6e1707] transition-colors">
                        View →
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-[#c4a09a] text-sm">No submissions yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
