@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#faf8f5] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Cozy Header Area -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-peony/30 text-espresso text-xs font-bold uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l2.6 6.9 7.4.6-5.6 4.8 1.8 7.2L12 17.8 5.8 21.5l1.8-7.2L2 9.5l7.4-.6z"></path>
                </svg>
                Handcrafted with Love
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-espresso mt-4 tracking-tight">
                Our Cozy Collection
            </h1>
            <p class="text-stone-500 mt-2 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                Take a moment to browse our fresh bakes, sweet treats, and signature espresso blends curated just for you.
            </p>
            <div class="w-16 h-1 bg-peony mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Search and Filter Panel -->
        <div class="bg-white rounded-[2.5rem] border border-stone-100 shadow-sm p-6 md:p-8 mb-10">
            <form id="filter-form" action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search Bar -->
                <div class="flex flex-col">
                    <label for="search" class="text-xs font-black uppercase tracking-wider text-espresso mb-2">Search Items</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="7"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <input type="text" id="search" name="search" placeholder="Search by name..."
                               class="w-full pl-10 pr-4 py-3 bg-[#faf8f5] border border-stone-100 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso placeholder-stone-400">
                    </div>
                </div>

                <!-- Categories Filter -->
                <div class="flex flex-col">
                    <label for="category_id" class="text-xs font-black uppercase tracking-wider text-espresso mb-2">Category</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.59 13.41L11 3.83A2 2 0 0 0 9.59 3.24L4 3a1 1 0 0 0-1 1l.24 5.59a2 2 0 0 0 .59 1.41l9.58 9.59a2 2 0 0 0 2.82 0l4.36-4.36a2 2 0 0 0 0-2.82z"></path>
                                <circle cx="7.5" cy="7.5" r="1.5"></circle>
                            </svg>
                        </span>
                        <select id="category_id" name="category_id" 
                                class="w-full pl-10 pr-9 py-3 bg-[#faf8f5] border border-stone-100 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso appearance-none cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="flex flex-col">
                    <label for="price_range" class="text-xs font-black uppercase tracking-wider text-espresso mb-2">Price Range</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </span>
                        <select id="price_range" name="price_range" 
                                class="w-full pl-10 pr-9 py-3 bg-[#faf8f5] border border-stone-100 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso appearance-none cursor-pointer">
                            <option value="">Any Price</option>
                            <option value="0-5">$0 to $5</option>
                            <option value="5-10">$5 to $10</option>
                            <option value="10-20">$10 to $20</option>
                            <option value="20-plus">$20+</option>
                        </select>
                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Availability Filter -->
                <div class="flex flex-col">
                    <label for="availability" class="text-xs font-black uppercase tracking-wider text-espresso mb-2">Availability</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </span>
                        <select id="availability" name="availability" 
                                class="w-full pl-10 pr-9 py-3 bg-[#faf8f5] border border-stone-100 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-peony/40 transition-all text-espresso appearance-none cursor-pointer">
                            <option value="available">In Stock &amp; Available</option>
                            <option value="">All (Show Out of Stock)</option>
                            <option value="out_of_stock">Out of Stock Only</option>
                        </select>
                        <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-espresso/40 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        <!-- Session Notifications -->
        @if(session('success'))
            <div class="max-w-3xl mx-auto mb-10 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl shadow-sm text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Smooth Cozy Product Grid -->
        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 transition-opacity duration-300">
            @include('products.partials.grid-items')
        </div>

    </div>
</div>

<!-- AJAX Dynamic Interceptor -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.getElementById('filter-form');
    const searchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category_id');
    const priceSelect = document.getElementById('price_range');
    const availabilitySelect = document.getElementById('availability');
    const productGrid = document.getElementById('product-grid');

    let searchTimeout = null;

    function fetchFilteredProducts() {
        // Opacity transition to look super sleek and responsive
        productGrid.style.opacity = '0.5';

        const formData = new FormData(filterForm);
        const queryParams = new URLSearchParams(formData).toString();
        const fetchUrl = `${filterForm.action}?${queryParams}`;

        // Update the browser URL without refreshing so users can share or reload filtered results
        window.history.pushState(null, '', fetchUrl);

        fetch(fetchUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            productGrid.innerHTML = data.html;
            productGrid.style.opacity = '1';
        })
        .catch(error => {
            console.error('Filtering error:', error);
            productGrid.style.opacity = '1';
        });
    }

    // Trigger fetch on select change
    [categorySelect, priceSelect, availabilitySelect].forEach(element => {
        element.addEventListener('change', fetchFilteredProducts);
    });

    // Debounce keyup on search to avoid hitting the DB with every single keystroke
    searchInput.addEventListener('keyup', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(fetchFilteredProducts, 300);
    });
});
</script>
@endsection