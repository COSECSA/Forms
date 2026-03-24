@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

<div class="mb-8">
    <h1 class="playfair text-3xl font-bold text-[#0f2744]">Dashboard</h1>
    <p class="text-gray-500 mt-1">Overview of all COSECSA programme submissions</p>
</div>

{{-- Stats --}}
<div class="grid grid-cols-4 gap-6 mb-10">
    <a href="{{ route('admin.submissions') }}" class="bg-white rounded-xl border bg-blue-50 text-blue-700 border-blue-100 p-6 shadow-sm hover:shadow-md transition hover:-translate-y-0.5 block">
        <div class="text-3xl font-bold">{{ $stats['total_submissions'] }}</div>
        <div class="text-sm font-medium mt-1 opacity-80">Submissions</div>
    </a>
    <a href="{{ route('admin.hospitals') }}" class="bg-white rounded-xl border bg-yellow-50 text-yellow-700 border-yellow-100 p-6 shadow-sm hover:shadow-md transition hover:-translate-y-0.5 block">
        <div class="text-3xl font-bold">{{ $stats['total_hospitals'] }}</div>
        <div class="text-sm font-medium mt-1 opacity-80">Hospitals</div>
    </a>
    <a href="{{ route('admin.trainers') }}" class="bg-white rounded-xl border bg-green-50 text-green-700 border-green-100 p-6 shadow-sm hover:shadow-md transition hover:-translate-y-0.5 block">
        <div class="text-3xl font-bold">{{ $stats['total_trainers'] }}</div>
        <div class="text-sm font-medium mt-1 opacity-80">Trainers</div>
    </a>
    <a href="{{ route('admin.trainees') }}" class="bg-white rounded-xl border bg-purple-50 text-purple-700 border-purple-100 p-6 shadow-sm hover:shadow-md transition hover:-translate-y-0.5 block">
        <div class="text-3xl font-bold">{{ $stats['total_trainees'] }}</div>
        <div class="text-sm font-medium mt-1 opacity-80">Trainees</div>
    </a>
</div>

{{-- Recent Submissions --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-[#0f2744]">Recent Submissions</h2>
        <a href="{{ route('admin.submissions') }}" class="text-sm text-blue-600 hover:underline">View all</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Director</th>
                <th class="px-6 py-3 text-left">Hospital</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($recent as $submission)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-[#0f2744]">{{ $submission->director_name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $submission->hospital->name ?? '—' }}</td>
                <td class="px-6 py-4 text-gray-400">{{ $submission->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.submissions.show', $submission) }}"
                        class="text-blue-600 hover:underline font-medium">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-400">No submissions yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection