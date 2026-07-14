
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          espresso: '#2D221E',
          peony: '#F4D4D1',
        }
      }
    }
  }
</script>

<nav class="p-4 space-y-1.5">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-espresso/70 hover:bg-peony/15 hover:text-espresso rounded-xl font-semibold text-sm transition-all duration-200 ease-in-out group">
        <span class="text-lg transition-transform group-hover:scale-110">📊</span> 
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 bg-peony text-espresso rounded-xl font-bold text-sm shadow-sm transition-all duration-200">
        <span class="text-lg">🍰</span> 
        <span>Products</span>
    </a>
</nav>

<!-- Main Card Header & Action -->
<div class="px-6 py-5 border-b border-peony/10 flex justify-between items-center bg-gradient-to-r from-peony/5 to-transparent">
    <div>
        <h2 class="font-bold text-espresso text-lg tracking-tight">Menu Items & Catalog</h2>
        <p class="text-xs text-espresso/50 mt-0.5">Manage details, update live inventory counts, or remove product offerings.</p>
    </div>
    <!-- Add New Button -->
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