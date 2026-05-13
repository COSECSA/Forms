@extends('admin.layout')
@section('title', 'Submissions')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
    @include('admin.partials.search-input', ['placeholder' => 'Search by director name, email, hospital…'])
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
        <tbody class="divide-y divide-gray-100" id="submissions-tbody">
            @forelse($submissions as $submission)
            {{-- hospitals JSON used by JS to build the <select> --}}
            <tr class="hover:bg-gray-50 transition" id="row-{{ $submission->id }}"
                data-id="{{ $submission->id }}"
                data-director-name="{{ $submission->director_name }}"
                data-director-email="{{ $submission->director_email }}"
                data-hospital-id="{{ $submission->hospital_id }}"
                data-hospital-name="{{ $submission->hospital->name ?? '' }}"
                data-update-url="{{ route('admin.submissions.update', $submission) }}">

                {{-- ── READ STATE ── --}}
                <td class="px-6 py-4 text-gray-400 read-cell">{{ $submission->id }}</td>
                <td class="px-6 py-4 font-medium text-[#0f2744] read-cell" data-field="director_name">{{ $submission->director_name }}</td>
                <td class="px-6 py-4 text-gray-500 read-cell" data-field="director_email">{{ $submission->director_email }}</td>
                <td class="px-6 py-4 text-gray-600 read-cell" data-field="hospital_name">{{ $submission->hospital->name ?? '—' }}</td>
                <td class="px-6 py-4 text-gray-400 read-cell">{{ $submission->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 read-cell">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.submissions.show', $submission) }}"
                            class="text-blue-600 hover:underline font-medium">View</a>
                        <button onclick="startEdit(this.closest('tr'))"
                            class="text-[#0f2744] hover:underline font-medium">Edit</button>
                        <button onclick="deleteRow(this.closest('tr'), '{{ route('admin.submissions.destroy', $submission) }}')"
                            class="text-red-500 hover:underline font-medium">Delete</button>
                    </div>
                </td>

                {{-- ── EDIT STATE (hidden until Edit clicked) ── --}}
                <td class="px-6 py-4 text-gray-400 edit-cell hidden">{{ $submission->id }}</td>
                <td class="px-6 py-4 edit-cell hidden">
                    <input type="text" name="director_name" value="{{ $submission->director_name }}"
                        class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30 min-w-[160px]">
                </td>
                <td class="px-6 py-4 edit-cell hidden">
                    <input type="email" name="director_email" value="{{ $submission->director_email }}"
                        class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30 min-w-[180px]">
                </td>
                <td class="px-6 py-4 edit-cell hidden">
                    <select name="hospital_id"
                        class="w-full border border-gray-300 rounded-lg px-2.5 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/30 min-w-[160px]">
                        @foreach($hospitals as $hospital)
                            <option value="{{ $hospital->id }}"
                                {{ $submission->hospital_id == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="px-6 py-4 text-gray-400 edit-cell hidden">{{ $submission->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 edit-cell hidden">
                    <div class="flex items-center gap-3">
                        <button onclick="saveEdit(this.closest('tr'))"
                            class="text-white bg-[#0f2744] hover:bg-[#1a3a5c] px-3 py-1.5 rounded-lg text-xs font-semibold transition save-btn">
                            Save
                        </button>
                        <button onclick="cancelEdit(this.closest('tr'))"
                            class="text-gray-500 hover:text-gray-700 text-xs font-medium">Cancel</button>
                    </div>
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

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function startEdit(row) {
    row.querySelectorAll('.read-cell').forEach(c => c.classList.add('hidden'));
    row.querySelectorAll('.edit-cell').forEach(c => c.classList.remove('hidden'));
}

function cancelEdit(row) {
    row.querySelectorAll('.edit-cell').forEach(c => c.classList.add('hidden'));
    row.querySelectorAll('.read-cell').forEach(c => c.classList.remove('hidden'));
}

async function deleteRow(row, url) {
    if (!confirm('Delete this submission? This cannot be undone.')) return;

    try {
        const res = await fetch(url, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        });

        if (!res.ok) { alert('Delete failed. Please try again.'); return; }

        // Fade out then remove the row
        row.style.transition = 'opacity 0.3s';
        row.style.opacity = '0';
        setTimeout(() => row.remove(), 300);
    } catch (e) {
        alert('Network error — please try again.');
    }
}

async function saveEdit(row) {
    const btn = row.querySelector('.save-btn');
    const url = row.dataset.updateUrl;

    const body = {
        director_name:  row.querySelector('[name="director_name"]').value.trim(),
        director_email: row.querySelector('[name="director_email"]').value.trim(),
        hospital_id:    row.querySelector('[name="hospital_id"]').value,
        _method: 'PATCH',
    };

    btn.textContent = 'Saving…';
    btn.disabled = true;

    try {
        const res = await fetch(url, {
            method: 'POST', // Laravel method spoofing via _method
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify(body),
        });

        if (!res.ok) {
            const err = await res.json();
            alert(Object.values(err.errors || {}).flat().join('\n') || 'Save failed.');
            return;
        }

        const data = await res.json();

        // Update read-state cells with the server-confirmed values
        row.querySelector('[data-field="director_name"]').textContent  = data.director_name;
        row.querySelector('[data-field="director_email"]').textContent = data.director_email;
        row.querySelector('[data-field="hospital_name"]').textContent  = data.hospital_name;

        cancelEdit(row);
    } catch (e) {
        alert('Network error — please try again.');
    } finally {
        btn.textContent = 'Save';
        btn.disabled = false;
    }
}
</script>

@endsection
