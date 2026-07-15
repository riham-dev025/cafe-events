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
                    onclick="openCreateModal()"
                    class="px-4 py-2.5 bg-espresso text-white rounded-xl text-xs font-bold hover:bg-espresso/90 shadow-sm hover:shadow active:scale-95 transition-all duration-200 flex items-center gap-2">

                    ＋ Add Product

                </button>


            </div>






            {{-- YOUR PRODUCTS TABLE/CARDS GO HERE --}}

            {{-- Keep your existing product listing here --}}







        </div>


    </main>


</div>



@endsection