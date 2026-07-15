@extends('layouts.app')

@section('content')


<div class="flex min-h-screen bg-[#FDF8F6]">


    {{-- SIDEBAR --}}
    @include('admin.sidebar')



    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col overflow-y-auto">


        {{-- TOP BAR --}}
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">

            <div class="flex items-center gap-4 w-1/3">

                <span class="text-espresso/40 text-lg">
                    🔍
                </span>

                <input 
                    type="text" 
                    placeholder="Search anything..." 
                    class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso"
                >

            </div>



            <div class="flex items-center gap-6 text-sm font-medium">


                <span class="text-espresso/40 hover:text-espresso cursor-pointer relative">
                    🔔

                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </span>



                <div class="flex items-center gap-2">

                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center">
                        ☕
                    </div>


                    <span class="text-espresso/80">
                        N&P Barista
                    </span>

                </div>


            </div>


        </header>




        {{-- PRODUCTS CONTENT --}}
        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">



            {{-- PAGE HEADER --}}
            <div class="px-6 py-5 border-b border-peony/10 flex justify-between items-center bg-gradient-to-r from-peony/5 to-transparent rounded-2xl">


                <div>

                    <h2 class="font-bold text-espresso text-lg tracking-tight">
                        Menu Items & Catalog
                    </h2>


                    <p class="text-xs text-espresso/50 mt-0.5">
                        Manage details, update live inventory counts, or remove product offerings.
                    </p>

                </div>



                <button 
    onclick="document.getElementById('createProductModal').classList.remove('hidden')"
    class="px-4 py-2.5 bg-espresso text-white rounded-xl text-xs font-bold hover:bg-espresso/90 shadow-sm hover:shadow active:scale-95 transition-all duration-200 flex items-center gap-2">

    ＋ Add Product

</button>


            </div>






       <div class="bg-white rounded-2xl shadow overflow-hidden">


<table class="w-full text-sm">


<thead class="bg-peony/10">

<tr>

<th class="p-4 text-left">
Name
</th>

<th class="p-4 text-left">
Category
</th>

<th class="p-4 text-left">
Price
</th>

<th class="p-4 text-left">
Stock
</th>

<th class="p-4 text-left">
Status
</th>

</tr>

</thead>



<tbody>


@forelse($products as $product)


<tr class="border-b border-peony/10">


<td class="p-4">

<div class="font-bold text-espresso">

{{ $product->name }}

</div>

<p class="text-xs text-espresso/50">

{{ $product->description }}

</p>

</td>



<td class="p-4">

{{ $product->category->name ?? 'No Category' }}

</td>



<td class="p-4">

${{ number_format($product->price,2) }}

</td>



<td class="p-4">

{{ $product->stock }}

</td>



<td class="p-4">

{{ ucfirst($product->status) }}

</td>



</tr>


@empty


<tr>

<td colspan="5" class="p-8 text-center text-espresso/50">

No products found.

</td>

</tr>


@endforelse


</tbody>


</table>


</div>



<div class="mt-6">

{{ $products->links() }}

</div>







        </div>


    </main>


</div>


<!-- CREATE PRODUCT MODAL -->

<div id="createProductModal"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">


<div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">


<div class="flex justify-between items-center mb-6">

<h2 class="font-bold text-lg text-espresso">
Add New Product
</h2>


<button 
onclick="document.getElementById('createProductModal').classList.add('hidden')"
class="text-espresso/50">

✕

</button>

</div>



<form action="{{ route('admin.products.store') }}" method="POST">

@csrf



<div class="space-y-4">


<div>

<label class="text-sm font-semibold">
Product Name
</label>

<input 
name="name"
required
class="w-full border rounded-xl p-3"
placeholder="Latte">

</div>




<div>

<label class="text-sm font-semibold">
Category
</label>


<select name="category_id"
class="w-full border rounded-xl p-3">


<option value="">
Choose category
</option>


@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->name }}

</option>


@endforeach


</select>


</div>





<div>

<label class="text-sm font-semibold">
Description
</label>


<textarea
name="description"
class="w-full border rounded-xl p-3"></textarea>


</div>




<div class="grid grid-cols-2 gap-4">


<div>

<label>
Price
</label>

<input 
type="number"
step="0.01"
name="price"
required
class="w-full border rounded-xl p-3">


</div>



<div>

<label>
Quantity
</label>

<input 
type="number"
name="stock"
required
class="w-full border rounded-xl p-3">


</div>


</div>




<div class="flex justify-end gap-3 mt-6">


<button type="button"
onclick="document.getElementById('createProductModal').classList.add('hidden')"
class="px-4 py-2 rounded-xl border">

Cancel

</button>



<button type="submit"
class="px-4 py-2 bg-espresso text-white rounded-xl">

Save Product

</button>



</div>


</div>


</form>


</div>


</div>
@endsection