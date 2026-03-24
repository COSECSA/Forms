@extends('admin.layout')
@section('title', 'Specialties')

@section('content')

<div class="mb-8">
    <h1 class="playfair text-3xl font-bold text-[#0f2744]">Specialties</h1>
    <p class="text-gray-500 mt-1">All COSECSA programmes and their trainee/trainer counts</p>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 text-sm">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-[#0f2744]">Programme List</h2>
        <span class="text-sm text-gray-400">{{ $specialties->count() }} specialties</span>
    </div>

    @if($specialties->isEmpty())
    <div class="px-6 py-10 text-center text-gray-400 text-sm">No specialties found.</div>
    @else
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Specialty / Programme</th>
                <th class="px-6 py-3 text-right">Trainers</th>
                <th class="px-6 py-3 text-right">Trainees</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($specialties as $specialty)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-[#0f2744]">{{ $specialty->name }}</td>
                <td class="px-6 py-4 text-right">
                    @if($specialty->trainer_count > 0)
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            {{ $specialty->trainer_count }}
                        </span>
                    @else
                        <span class="text-gray-300">0</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    @if($specialty->trainee_count > 0)
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                            {{ $specialty->trainee_count }}
                        </span>
                    @else
                        <span class="text-gray-300">0</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right whitespace-nowrap">
                    <button type="button"
                        onclick="openEditModal({{ $specialty->id }}, {{ json_encode($specialty->name) }})"
                        class="text-blue-600 hover:text-blue-800 text-xs font-semibold mr-3">
                        Edit
                    </button>
                    <form method="POST" action="{{ route('admin.specialties.destroy', $specialty) }}"
                        class="inline"
                        onsubmit="return confirm('Delete \'{{ addslashes($specialty->name) }}\'? Trainers linked to this specialty will lose their programme.')">
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
        <tfoot class="bg-gray-50 border-t border-gray-200">
            <tr>
                <td class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</td>
                <td class="px-6 py-3 text-right text-xs font-bold text-gray-700">{{ $specialties->sum('trainer_count') }}</td>
                <td class="px-6 py-3 text-right text-xs font-bold text-gray-700">{{ $specialties->sum('trainee_count') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    @endif
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-semibold text-[#0f2744] mb-5">Edit Specialty</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Specialty Name</label>
                <input type="text" name="name" id="editName" required
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
    const baseUrl = '{{ url("admin/specialties") }}';

    function openEditModal(id, name) {
        document.getElementById('editForm').action = baseUrl + '/' + id;
        document.getElementById('editName').value = name;
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });
</script>

@endsection
