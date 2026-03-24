@extends('admin.layout')
@section('title', 'Submission Detail')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.submissions') }}" class="text-sm text-gray-400 hover:text-gray-600 flex items-center gap-1 mb-4">
        ← Back to Submissions
    </a>
    <h1 class="playfair text-3xl font-bold text-[#0f2744]">{{ $submission->director_name }}</h1>
    <p class="text-gray-500 mt-1">{{ $submission->hospital->name ?? '—' }} · Submitted {{ $submission->created_at->format('d M Y') }}</p>
</div>

@foreach($submission->hospital->trainers as $trainer)
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6 overflow-hidden">
    <div class="px-6 py-4 bg-[#0f2744] flex items-center justify-between">
        <div>
            <div class="text-white font-semibold">{{ $trainer->name }}</div>
            <div class="text-white/50 text-sm">{{ $trainer->email }}</div>
        </div>
        <span class="bg-yellow-400/20 text-yellow-300 text-xs font-semibold px-3 py-1 rounded-full border border-yellow-400/30">
            {{ $trainer->program->name ?? 'No Program' }}
        </span>
    </div>
    <div class="p-6">
        <div class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-3">Trainees</div>
        @if($trainer->trainees->isEmpty())
            <p class="text-gray-400 text-sm">No trainees listed</p>
        @else
        <div class="grid grid-cols-2 gap-3">
            @foreach($trainer->trainees as $trainee)
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100">
                <div class="w-8 h-8 rounded-full bg-[#0f2744] text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr($trainee->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-sm text-[#0f2744]">{{ $trainee->name }}</div>
                    <div class="text-xs text-gray-400">{{ $trainee->email }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endforeach

@endsection