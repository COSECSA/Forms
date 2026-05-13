@extends('admin.layout')
@section('title', 'Edit Submission')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.submissions.show', $submission) }}" class="text-sm text-gray-400 hover:text-gray-600 flex items-center gap-1 mb-4">
        ← Back to Submission
    </a>
    <h1 class="playfair text-3xl font-bold text-[#0f2744]">Edit Submission</h1>
    <p class="text-gray-500 mt-1">Update any details for this submission, including trainers and trainees.</p>
</div>

@if($errors->any())
<div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
    <strong>Please fix the following:</strong>
    <ul class="mt-1 list-disc list-inside">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.submissions.update', $submission) }}">
    @csrf
    @method('PUT')

    {{-- Section 1: Programme Director --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-7 h-7 rounded-full bg-[#0f2744] text-white text-xs font-bold flex items-center justify-center">1</div>
            <div>
                <div class="font-semibold text-[#0f2744] text-sm">Programme Director Details</div>
                <div class="text-xs text-gray-400">The person who submitted the form</div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Full Name</label>
                    <input type="text" name="director_name" value="{{ old('director_name', $submission->director_name) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30 @error('director_name') border-red-400 @enderror">
                    @error('director_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Email Address</label>
                    <input type="email" name="director_email" value="{{ old('director_email', $submission->director_email) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30 @error('director_email') border-red-400 @enderror">
                    @error('director_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Section 2: Hospital --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-7 h-7 rounded-full bg-[#0f2744] text-white text-xs font-bold flex items-center justify-center">2</div>
            <div>
                <div class="font-semibold text-[#0f2744] text-sm">Hospital</div>
                <div class="text-xs text-gray-400">The affiliated hospital</div>
            </div>
        </div>
        <div class="p-6">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Select Hospital</label>
            <select name="hospital_id" class="w-full max-w-sm border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30 @error('hospital_id') border-red-400 @enderror">
                <option value="">— Select hospital —</option>
                @foreach($hospitals as $hospital)
                    <option value="{{ $hospital->id }}" {{ old('hospital_id', $submission->hospital_id) == $hospital->id ? 'selected' : '' }}>
                        {{ $hospital->name }}{{ $hospital->country ? ' — ' . $hospital->country : '' }}
                    </option>
                @endforeach
            </select>
            @error('hospital_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- Section 3: Trainers & Trainees --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-7 h-7 rounded-full bg-[#0f2744] text-white text-xs font-bold flex items-center justify-center">3</div>
            <div>
                <div class="font-semibold text-[#0f2744] text-sm">Trainers &amp; Trainees</div>
                <div class="text-xs text-gray-400">Edit, add, or remove trainers and their trainees</div>
            </div>
        </div>
        <div class="p-6">
            <div id="trainers-container" class="flex flex-col gap-4">
                <div class="hidden text-center py-10 text-gray-400 text-sm" id="empty-state">
                    No trainers added yet. Click the button below to add one.
                </div>
            </div>
            <button type="button" onclick="addTrainer()"
                class="mt-4 w-full border-2 border-dashed border-gray-300 rounded-xl py-3 text-sm font-semibold text-[#0f2744] hover:border-[#0f2744] hover:bg-gray-50 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add Trainer
            </button>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3 mt-2">
        <button type="submit"
            class="bg-[#0f2744] text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#1a3a5c] transition">
            Save Changes
        </button>
        <a href="{{ route('admin.submissions.show', $submission) }}"
            class="text-gray-500 text-sm hover:text-gray-700">Cancel</a>
    </div>

</form>

<script>
let trainerCount = 0;
const programs = @json($programs);
const existingTrainers = @json($submission->trainers->map(function($t) {
    return [
        'name'       => $t->name,
        'email'      => $t->email,
        'program_id' => $t->program_id,
        'trainees'   => $t->trainees->map(fn($tr) => [
            'name'        => $tr->name,
            'email'       => $tr->email,
            'pen'         => $tr->pen ?? '',
            'gender'      => $tr->gender ?? '',
            'nationality' => $tr->nationality ?? '',
        ])->values()->all(),
    ];
})->values()->all());

function escapeHtml(str) {
    const div = document.createElement('div');
    div.appendChild(document.createTextNode(str || ''));
    return div.innerHTML;
}

function buildTraineeRow(trainerIndex, traineeIndex, t) {
    t = t || {};
    return `
    <div class="trainee-row border border-gray-200 rounded-lg p-3 bg-gray-50" id="trainee-${trainerIndex}-${traineeIndex}">
        <div class="grid grid-cols-3 gap-2 mb-2">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Full Name</label>
                <input type="text" name="trainers[${trainerIndex}][trainees][${traineeIndex}][name]"
                    value="${escapeHtml(t.name)}" placeholder="Trainee full name"
                    class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-[#0f2744]/30">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Email</label>
                <input type="email" name="trainers[${trainerIndex}][trainees][${traineeIndex}][email]"
                    value="${escapeHtml(t.email)}" placeholder="Trainee email"
                    class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-[#0f2744]/30">
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">PEN</label>
                <input type="text" name="trainers[${trainerIndex}][trainees][${traineeIndex}][pen]"
                    value="${escapeHtml(t.pen)}" placeholder="e.g. PEN-2024-001"
                    class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-[#0f2744]/30">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2 items-end">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Gender</label>
                <select name="trainers[${trainerIndex}][trainees][${traineeIndex}][gender]"
                    class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-[#0f2744]/30">
                    <option value="">Select</option>
                    <option value="Male" ${(t.gender||'')==='Male'?'selected':''}>Male</option>
                    <option value="Female" ${(t.gender||'')==='Female'?'selected':''}>Female</option>
                </select>
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Nationality</label>
                <input type="text" name="trainers[${trainerIndex}][trainees][${traineeIndex}][nationality]"
                    value="${escapeHtml(t.nationality)}" placeholder="e.g. Kenyan"
                    class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-[#0f2744]/30">
            </div>
            <div>
                <button type="button" onclick="removeTrainee('${trainerIndex}-${traineeIndex}')"
                    class="w-full border border-red-200 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-lg py-1.5 text-xs transition">
                    Remove
                </button>
            </div>
        </div>
    </div>`;
}

function addTrainer(prefill) {
    const container = document.getElementById('trainers-container');
    document.getElementById('empty-state').classList.add('hidden');

    const index = trainerCount++;
    const trainerNum = container.querySelectorAll('.trainer-card').length + 1;
    const programOptions = programs.map(p =>
        `<option value="${p.id}" ${(prefill && prefill.program_id == p.id) ? 'selected' : ''}>${escapeHtml(p.name)}</option>`
    ).join('');

    const card = document.createElement('div');
    card.className = 'trainer-card border border-gray-200 rounded-xl overflow-hidden';
    card.id = `trainer-${index}`;
    card.dataset.index = index;
    card.innerHTML = `
        <div class="px-4 py-3 bg-[#0f2744]/5 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="bg-[#0f2744] text-white text-xs font-bold px-2.5 py-1 rounded-full">Trainer ${trainerNum}</span>
                <span id="trainer-label-${index}" class="text-sm text-gray-400">${prefill ? escapeHtml(prefill.name) : 'Fill in details below'}</span>
            </div>
            <button type="button" onclick="removeTrainer(${index})"
                class="text-xs text-gray-400 hover:text-red-500 hover:bg-red-50 px-2 py-1 rounded transition">
                Remove
            </button>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-3 gap-3 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Trainer Name</label>
                    <input type="text" name="trainers[${index}][name]"
                        value="${prefill ? escapeHtml(prefill.name) : ''}"
                        placeholder="Dr. Jane Smith"
                        oninput="document.getElementById('trainer-label-${index}').textContent = this.value || 'Fill in details below'"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Email</label>
                    <input type="email" name="trainers[${index}][email]"
                        value="${prefill ? escapeHtml(prefill.email) : ''}"
                        placeholder="trainer@hospital.org"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Programme</label>
                    <select name="trainers[${index}][program_id]"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30">
                        <option value="">Select programme</option>
                        ${programOptions}
                    </select>
                </div>
            </div>
            <div class="border-t border-dashed border-gray-200 pt-3">
                <div class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-3">Trainees</div>
                <div id="trainees-container-${index}" class="flex flex-col gap-2"></div>
                <button type="button" onclick="addTrainee(${index})"
                    class="mt-2 text-sm font-semibold text-[#0f2744] hover:underline flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Trainee
                </button>
            </div>
        </div>`;
    container.appendChild(card);

    // Pre-fill trainees
    if (prefill && prefill.trainees) {
        prefill.trainees.forEach((t, ti) => {
            const tc = document.getElementById(`trainees-container-${index}`);
            tc.insertAdjacentHTML('beforeend', buildTraineeRow(index, ti, t));
        });
    }
}

function removeTrainer(index) {
    const card = document.getElementById(`trainer-${index}`);
    if (card) card.remove();
    const container = document.getElementById('trainers-container');
    if (!container.querySelector('.trainer-card')) {
        document.getElementById('empty-state').classList.remove('hidden');
    }
}

function addTrainee(trainerIndex) {
    const container = document.getElementById(`trainees-container-${trainerIndex}`);
    container.insertAdjacentHTML('beforeend', buildTraineeRow(trainerIndex, container.children.length, {}));
}

function removeTrainee(id) {
    const el = document.getElementById(`trainee-${id}`);
    if (el) el.remove();
}

// Boot: render existing trainers
existingTrainers.forEach(t => addTrainer(t));
if (!existingTrainers.length) {
    document.getElementById('empty-state').classList.remove('hidden');
}
</script>

@endsection
