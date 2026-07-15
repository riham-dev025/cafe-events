@extends('layouts.app')

@section('content')


<h1 class="text-3xl font-bold text-peony mb-8">
    Staff Members
</h1>


<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

<table class="w-full">


<thead class="bg-peony/10">

<tr>

<th class="p-4 text-left">
Name
</th>

<th class="p-4 text-left">
Email
</th>

<th class="p-4 text-left">
Position
</th>

<th class="p-4 text-left">
Status
</th>

</tr>

</thead>


<tbody>

@foreach($staff as $member)

<tr class="border-b">

<td class="p-4">
{{ $member->user->name }}
</td>

<td class="p-4">
{{ $member->user->email }}
</td>

<td class="p-4">
{{ ucfirst($member->position) }}
</td>

<td class="p-4">
{{ ucfirst($member->status) }}
</td>


</tr>

@endforeach


</tbody>


</table>

</div>


@endsection