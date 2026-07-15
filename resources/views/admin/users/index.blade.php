@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold text-peony mb-8">
    Customers
</h1>


<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

<table class="w-full">

<thead class="bg-peony/10">

<tr>
<th class="p-4 text-left">Name</th>
<th class="p-4 text-left">Email</th>
<th class="p-4 text-left">Phone</th>
</tr>

</thead>


<tbody>

@foreach($users as $user)

<tr class="border-b">

<td class="p-4">
{{ $user->name }}
</td>

<td class="p-4">
{{ $user->email }}
</td>

<td class="p-4">
{{ $user->phone ?? 'N/A' }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>


@endsection