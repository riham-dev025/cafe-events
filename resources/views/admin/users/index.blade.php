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
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-black text-espresso">
                        Customers
                    </h1>
                    <p class="text-xs text-stone-500 mt-1">Manage and search your registered customers</p>
                </div>
                
                <!-- Search Input -->
                <div class="relative w-full md:w-80">
                    <input type="text" id="user-search" placeholder="Search customers..."
                           class="w-full pl-10 pr-4 py-2.5 bg-white border border-stone-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400 shadow-sm">
                    <span class="absolute left-3.5 top-3 text-stone-400">🔍</span>
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-[2rem] border border-stone-100 shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-peony/10">
                        <tr>
                            <th class="p-4 text-left text-xs font-black uppercase tracking-wider text-espresso">Name</th>
                            <th class="p-4 text-left text-xs font-black uppercase tracking-wider text-espresso">Email</th>
                            <th class="p-4 text-left text-xs font-black uppercase tracking-wider text-espresso">Phone</th>
                        </tr>
                    </thead>
                    
                    <!-- Table body target for AJAX updates -->
                    <tbody id="users-table-body" class="transition-opacity duration-200">
                        @include('admin.users.partials.table-rows')
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- AJAX Dynamic Interceptor -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('user-search');
    const tableBody = document.getElementById('users-table-body');
    let searchTimeout = null;

    function fetchUsers() {
        tableBody.style.opacity = '0.5';

        const query = encodeURIComponent(searchInput.value);
        const fetchUrl = `{{ route('admin.users.index') }}?search=${query}`;

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
            console.error('Customer filtering error:', error);
            tableBody.style.opacity = '1';
        });
    }

    searchInput.addEventListener('keyup', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(fetchUsers, 250);
    });
});
</script>
@endsection