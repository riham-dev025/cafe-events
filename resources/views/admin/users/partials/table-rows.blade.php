@forelse($users as $user)
    <tr class="border-b hover:bg-stone-50/50 transition-colors duration-150">
        <td class="p-4 text-stone-800 font-medium">
            {{ $user->name }}
        </td>
        <td class="p-4 text-stone-600">
            {{ $user->email }}
        </td>
        <td class="p-4 text-stone-500">
            {{ $user->phone ?? 'N/A' }}
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="p-8 text-center text-stone-400 text-sm">
            No customers found starting with that name.
        </td>
    </tr>
@endforelse