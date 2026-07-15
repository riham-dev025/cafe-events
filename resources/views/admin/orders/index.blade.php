@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#FDF8F6]">


@include('admin.sidebar')


<main class="flex-1 p-8">


<h1 class="text-3xl font-bold text-espresso mb-6">
    Orders
</h1>



<!-- FILTERS -->

<div class="bg-white rounded-2xl p-5 border border-peony/20 mb-6">

<form method="GET" class="flex gap-4">


<select name="status"
class="border rounded-xl px-4 py-2">

<option value="All">
All
</option>

<option value="Pending">
Pending
</option>

<option value="Preparing">
Preparing
</option>

<option value="Completed">
Completed
</option>

<option value="Cancelled">
Cancelled
</option>


</select>



<input 
type="text"
name="search"
placeholder="Search customer..."
class="border rounded-xl px-4 py-2 flex-1">



<button
class="bg-peony px-5 py-2 rounded-xl">
Search
</button>


</form>


</div>





<!-- ORDERS TABLE -->


<div class="bg-white rounded-2xl border border-peony/20 overflow-hidden">


<table class="w-full">


<thead class="bg-[#FDF8F6]">

<tr class="text-left text-sm">

<th class="p-4">
ID
</th>


<th>
Customer
</th>


<th>
Status
</th>


<th>
Payment
</th>


<th>
Total
</th>


<th>
Action
</th>


</tr>

</thead>



<tbody>


@foreach($orders as $order)


<tr class="border-t">


<td class="p-4 font-bold">
#{{ $order->id }}
</td>



<td>

{{ $order->user->name ?? 'Guest' }}

</td>




<td>


<span class="
px-3 py-1 rounded-full text-sm

@if($order->order_status=='Pending')
bg-yellow-100 text-yellow-700

@elseif($order->order_status=='Preparing')
bg-blue-100 text-blue-700

@elseif($order->order_status=='Completed')
bg-green-100 text-green-700

@else
bg-red-100 text-red-700

@endif

">


{{ $order->order_status }}


</span>


</td>




<td>

{{ $order->payment_status }}

</td>




<td>

${{number_format($order->total_amount,2)}}

</td>




<td>


<a href="{{route('admin.orders.show',$order->id)}}"

class="px-4 py-2 rounded-xl bg-peony/20">

View

</a>


</td>



</tr>


@endforeach


</tbody>


</table>


</div>



<div class="mt-5">

{{ $orders->links() }}

</div>


</main>

</div>


@endsection