@extends('admin.layout')
@section('title', 'Submissions')

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="playfair text-3xl font-bold text-[#0f2744]">Submissions</h1>
        <p class="text-gray-500 mt-1">All programme director submissions</p>
    </div>
    <a href="{{ route('admin.export') }}"
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
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Director</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Hospital</th>
                <th class="px-6 py-3 text-left">Submitted</th>
                <th class="px-6 py-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($submissions as $submission)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-400">{{ $submission->id }}</td>
                <td class="px-6 py-4 font-medium text-[#0f2744]">{{ $submission->director_name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $submission->director_email }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $submission->hospital->name ?? '—' }}</td>
                <td class="px-6 py-4 text-gray-400">{{ $submission->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.submissions.show', $submission) }}"
                        class="text-blue-600 hover:underline font-medium">View Details</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-400">No submissions found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $submissions->links() }}
    </div>
</div>

@endsection