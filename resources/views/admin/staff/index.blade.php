@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#faf8f5] flex flex-col md:flex-row">
    
    <!-- Sidebar Container -->
    <div class="w-full md:w-64 flex-shrink-0 bg-white border-r border-stone-100 shadow-sm">
        @include('admin.sidebar')
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-6 md:p-12">
        <div class="max-w-6xl mx-auto">
            
            <!-- Success Flash Banner -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-sm rounded-2xl flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-black text-espresso">
                        Staff Members
                    </h1>
                    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-800 text-sm rounded-2xl">
        <strong class="block font-bold mb-1">Oops! We found some errors:</strong>
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <p class="text-xs text-stone-500 mt-1">Manage and search your administration team</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <!-- Search Input -->
                    <div class="relative w-full md:w-64">
                        <input type="text" id="staff-search" placeholder="Search staff..."
                               class="w-full pl-10 pr-4 py-2 bg-white border border-stone-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400 shadow-sm">
                        <span class="absolute left-3.5 top-2.5 text-stone-400">🔍</span>
                    </div>

                    <!-- Open Modal Button -->
                    <button onclick="toggleModal(true)" class="bg-peony text-white font-bold text-xs px-4 py-2.5 rounded-2xl shadow-md hover:brightness-95 hover:shadow-lg transition-all duration-150 whitespace-nowrap">
                        + Add Staff
                    </button>
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-[2rem] border border-stone-100 shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-peony/10">
                        <tr>
                            <th class="p-4 text-left text-xs font-black uppercase tracking-wider text-espresso">Name</th>
                            <th class="p-4 text-left text-xs font-black uppercase tracking-wider text-espresso">Email</th>
                            <th class="p-4 text-left text-xs font-black uppercase tracking-wider text-espresso">Role / Title</th>
                            <th class="p-4 text-right text-xs font-black uppercase tracking-wider text-espresso">Actions</th>
                        </tr>
                    </thead>
                    
                    <!-- Table body target for AJAX updates -->
                    <tbody id="staff-table-body" class="transition-opacity duration-200">
                        @include('admin.staff.partials.table-rows')
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Beautiful Pop-Up Modal (Add Staff) -->
<div id="add-staff-modal" class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden transition-opacity duration-300">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md p-8 relative mx-4 transform scale-95 transition-transform duration-300">
        <button onclick="toggleModal(false)" class="absolute top-6 right-6 text-stone-400 hover:text-stone-700 font-bold text-xl">&times;</button>
        
        <h2 class="text-2xl font-black text-espresso mb-1">Add New Staff</h2>
        <p class="text-xs text-stone-500 mb-6">Create a login profile with automated 'Staff' permissions.</p>

        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf
            
            <!-- Name Input -->
            <div class="mb-4">
                <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Full Name</label>
                <input type="text" name="name" required placeholder="e.g. Jean Doe"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400">
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Email Address</label>
                <input type="email" name="email" required placeholder="name@yourdomain.com"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400">
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Temporary Password (Min 8 Characters)</label>
                <input type="password" name="password" required placeholder="Min 8 characters"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400">
            </div>

            <!-- Position Input -->
            <div class="mb-4">
                <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Position / Title</label>
                <input type="text" name="position" required placeholder="e.g. Barista, Kitchen Staff, Manager"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400">
            </div>

            <!-- Status Dropdown (Defaulting to Active) -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-stone-700 uppercase mb-1">Employment Status</label>
                <select name="status" required class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="on-leave">On Leave</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="toggleModal(false)" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-xs rounded-xl transition-all">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2.5 bg-peony hover:brightness-95 text-white font-bold text-xs rounded-xl shadow-md transition-all">
                    Create Staff Account
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts for Modal & AJAX -->
<script>
// Modal Toggler
function toggleModal(show) {
    const modal = document.getElementById('add-staff-modal');
    if (show) {
        modal.classList.remove('hidden');
    } else {
        modal.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('staff-search');
    const tableBody = document.getElementById('staff-table-body');
    let searchTimeout = null;

    function fetchStaff() {
        tableBody.style.opacity = '0.5';

        const query = encodeURIComponent(searchInput.value);
        const fetchUrl = `{{ route('admin.staff.index') }}?search=${query}`;

        fetch(fetchUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response failure');
            return response.json();
        })
        .then(data => {
            tableBody.innerHTML = data.html;
            tableBody.style.opacity = '1';
        })
        .catch(error => {
            console.error('Staff filtering error:', error);
            tableBody.style.opacity = '1';
        });
    }

    searchInput.addEventListener('keyup', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(fetchStaff, 250);
    });
});
</script>
@endsection