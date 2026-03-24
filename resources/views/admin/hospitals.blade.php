@extends('admin.layout')
@section('title', 'Hospitals')

@section('content')

<div class="mb-8">
    <h1 class="playfair text-3xl font-bold text-[#0f2744]">Hospitals</h1>
    <p class="text-gray-500 mt-1">All registered hospitals and their trainee counts</p>
</div>

{{-- Flash message --}}
@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 text-sm">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl px-5 py-4 text-sm">
    {{ $errors->first() }}
</div>
@endif

<div class="grid grid-cols-2 gap-6 mb-8">

    {{-- Hospitals table --}}
    <div class="col-span-2 xl:col-span-1 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-[#0f2744]">Hospital List</h2>
            <span class="text-sm text-gray-400">{{ $hospitals->count() }} total</span>
        </div>

        @if($hospitals->isEmpty())
        <div class="px-6 py-10 text-center text-gray-400 text-sm">No hospitals yet. Import one using the form.</div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Hospital</th>
                        <th class="px-6 py-3 text-left">Country</th>
                        <th class="px-6 py-3 text-right">Trainees</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($hospitals as $hospital)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 font-medium text-[#0f2744]">{{ $hospital->name }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $hospital->country ?: '—' }}</td>
                        <td class="px-6 py-3 text-right">
                            @if($hospital->trainee_count > 0)
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                    {{ $hospital->trainee_count }}
                                </span>
                            @else
                                <span class="text-gray-300">0</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right whitespace-nowrap">
                            {{-- Edit --}}
                            <button type="button"
                                onclick="openEditModal({{ $hospital->id }}, {{ json_encode($hospital->name) }}, {{ json_encode($hospital->country ?? '') }})"
                                class="text-blue-600 hover:text-blue-800 text-xs font-semibold mr-3">
                                Edit
                            </button>
                            {{-- Delete --}}
                            <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital) }}"
                                class="inline"
                                onsubmit="return confirm('Delete {{ addslashes($hospital->name) }}? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- CSV Upload --}}
    <div class="col-span-2 xl:col-span-1 bg-white rounded-xl border border-gray-200 shadow-sm p-6 self-start">
        <h2 class="font-semibold text-[#0f2744] mb-1">Import Hospitals via CSV</h2>
        <p class="text-sm text-gray-500 mb-5">
            Upload a CSV file with two columns: <span class="font-medium text-gray-700">name</span> and
            <span class="font-medium text-gray-700">country</span>. A header row is optional and will be
            skipped automatically. Existing hospitals (matched by name) won't be duplicated.
        </p>

        {{-- Format example --}}
        <div class="mb-5 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-xs font-mono text-gray-600 leading-relaxed">
            name,country<br>
            Kenyatta National Hospital,Kenya<br>
            Mulago Hospital,Uganda<br>
            Chris Hani Baragwanath,South Africa
        </div>

        <form method="POST" action="{{ route('admin.hospitals.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">CSV File</label>
                <input type="file" name="csv_file" accept=".csv,.txt"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#0f2744] file:text-white hover:file:bg-[#1a3a5c] cursor-pointer border border-gray-200 rounded-lg p-1">
            </div>
            <button type="submit"
                class="w-full bg-[#0f2744] text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-[#1a3a5c] transition">
                Upload &amp; Import
            </button>
        </form>
    </div>

</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-semibold text-[#0f2744] mb-5">Edit Hospital</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Hospital Name</label>
                <input type="text" name="name" id="editName" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/20">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" name="country" id="editCountry"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2744]/20">
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 bg-[#0f2744] text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-[#1a3a5c] transition">
                    Save Changes
                </button>
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 border border-gray-200 text-gray-600 text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const baseUrl = '{{ url("admin/hospitals") }}';

    function openEditModal(id, name, country) {
        document.getElementById('editForm').action = baseUrl + '/' + id;
        document.getElementById('editName').value = name;
        document.getElementById('editCountry').value = country;
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close on backdrop click
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });
</script>

@endsection
