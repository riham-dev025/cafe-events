@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-[#FDF8F6] text-espresso font-sans overflow-hidden">
    <aside class="w-64 bg-white border-r border-peony/20 flex flex-col justify-between shrink-0">
        <div>
            <div class="p-6 border-b border-peony/10 flex items-center gap-3">
                <div class="h-10 w-10 bg-peony/20 rounded-xl flex items-center justify-center text-espresso font-bold text-lg">🌸</div>
                <div>
                    <h2 class="font-bold text-espresso text-base tracking-tight">Nook & Peony</h2>
                    <span class="text-xs text-espresso/40">RestroPanel v1.0</span>
                </div>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">📊</span> Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">🛍️</span> Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">🍰</span> Products
                </a>
                <a href="{{ route('admin.events.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">📅</span> Events
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.bookings.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">🌸</span> Bookings
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-peony/10 bg-peony/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-espresso text-white rounded-full flex items-center justify-center font-bold text-sm">AD</div>
                <div>
                    <p class="text-sm font-semibold text-espresso">Admin Account</p>
                    <p class="text-xs text-espresso/40">Role: Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-xl border border-peony/30 bg-white px-3 py-2 text-sm font-semibold text-espresso/70 transition-all duration-200 hover:-translate-y-0.5 hover:bg-peony/10 hover:text-espresso">
                    <span class="text-base transition-transform duration-200 group-hover:scale-110">🚪</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-4 w-1/3">
                <span class="text-espresso/40 text-lg">🔍</span>
                <input type="text" placeholder="Search anything..." class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso" />
            </div>

            <div class="flex items-center gap-6 text-sm font-medium">
                <span class="text-espresso/40 hover:text-espresso cursor-pointer relative">
                    🔔 <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </span>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center">☕</div>
                    <span class="text-espresso/80">N&P Barista</span>
                </div>
            </div>
        </header>

        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">
            <div class="px-6 py-5 border-b border-peony/10 flex justify-between items-center bg-gradient-to-r from-peony/5 to-transparent rounded-2xl">
                <div>
                    <h2 class="font-bold text-espresso text-lg tracking-tight">Menu Items & Catalog</h2>
                    <p class="text-xs text-espresso/50 mt-0.5">Manage details, update live inventory counts, or remove product offerings.</p>
                </div>
                <button onclick="openCreateModal()" class="px-4 py-2.5 bg-espresso text-white rounded-xl text-xs font-bold hover:bg-espresso/90 shadow-sm hover:shadow active:scale-95 transition-all duration-200 flex items-center gap-2">
                    <span class="text-sm font-semibold">＋</span> Add Product
                </button>

                
            </div>

<!-- ==========================================
      MODAL: CREATE PRODUCT
     ========================================== -->
<div id="createModal" class="fixed inset-0 z-50 hidden bg-espresso/40 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-300">
    <div class="bg-white rounded-3xl max-w-md w-full border border-peony/10 shadow-2xl overflow-hidden transform scale-100 transition-all">
        <!-- Modal Header -->
        <div class="bg-peony/15 border-b border-peony/10 px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xl">✨</span>
                <h3 class="font-extrabold text-espresso text-base tracking-tight">Add New Menu Product</h3>
            </div>
            <button onclick="closeCreateModal()" class="h-8 w-8 rounded-full bg-white/80 border border-peony/10 text-espresso/60 hover:text-espresso flex items-center justify-center text-xs transition duration-150">✕</button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" class="p-6 space-y-5 bg-[#FDF8F6]/20">
            @csrf
            
            <!-- Product Name -->
            <div>
                <label class="block text-[11px] font-bold text-espresso/60 uppercase tracking-wider mb-1.5">Product Name</label>
                <input type="text" name="name" required placeholder="e.g., Lavender Matcha Cake" 
                       class="w-full p-3 rounded-xl border border-peony/30 bg-[#FDF8F6]/50 text-sm text-espresso placeholder:text-espresso/30 focus:border-peony focus:ring-4 focus:ring-peony/15 focus:outline-none transition duration-150">
            </div>

            <!-- Price & Stock Grid -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-espresso/60 uppercase tracking-wider mb-1.5">Price ($)</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-3 text-espresso/40 text-sm font-semibold">$</span>
                        <input type="number" step="0.01" name="price" required placeholder="0.00" 
                               class="w-full pl-7 pr-3 p-3 rounded-xl border border-peony/30 bg-[#FDF8F6]/50 text-sm text-espresso placeholder:text-espresso/30 focus:border-peony focus:ring-4 focus:ring-peony/15 focus:outline-none transition duration-150">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-espresso/60 uppercase tracking-wider mb-1.5">Initial Stock</label>
                    <input type="number" name="stock" required placeholder="10" 
                           class="w-full p-3 rounded-xl border border-peony/30 bg-[#FDF8F6]/50 text-sm text-espresso placeholder:text-espresso/30 focus:border-peony focus:ring-4 focus:ring-peony/15 focus:outline-none transition duration-150">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[11px] font-bold text-espresso/60 uppercase tracking-wider mb-1.5">Description</label>
                <textarea name="description" rows="3" placeholder="Describe the flavors, ingredients, or sizing details..." 
                          class="w-full p-3 rounded-xl border border-peony/30 bg-[#FDF8F6]/50 text-sm text-espresso placeholder:text-espresso/30 focus:border-peony focus:ring-4 focus:ring-peony/15 focus:outline-none transition duration-150 resize-none"></textarea>
            </div>

            <!-- Actions Footer -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-peony/10">
                <button type="button" onclick="closeCreateModal()" class="px-4.5 py-2.5 border border-peony/20 text-espresso/60 text-xs font-bold rounded-xl hover:bg-peony/5 hover:text-espresso transition duration-150">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2.5 bg-espresso text-white text-xs font-bold rounded-xl hover:bg-espresso/90 shadow-sm active:scale-95 transition-all duration-150">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Create Modal triggers
    function openCreateModal() {
        const modal = document.getElementById('createModal');
        modal.classList.remove('hidden');
        // Let background blur animate smoothly
        document.body.style.overflow = 'hidden'; 
    }
    
    function closeCreateModal() {
        const modal = document.getElementById('createModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    // Close modal if user clicks anywhere outside of the modal container box
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('createModal');
        if (e.target === modal) {
            closeCreateModal();
        }
    });
</script>
        </div>
    </main>
</div>
@endsection