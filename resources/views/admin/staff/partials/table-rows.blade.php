@forelse($staff as $member)
    <tr class="border-b hover:bg-stone-50/50 transition-colors duration-150">
        <td class="p-4 text-stone-800 font-medium">
            {{ $member->user->name ?? 'N/A' }}
        </td>
        <td class="p-4 text-stone-600">
            {{ $member->user->email ?? 'N/A' }}
        </td>
        <td class="p-4 text-stone-500">
            {{ $member->role ?? 'Staff Member' }}
        </td>
        <td class="p-4 text-right">
            <!-- Delete Button Form -->
            <form action="{{ route('admin.staff.destroy', $member->id) }}" method="POST" 
                  onsubmit="return confirm('Are you absolutely sure you want to remove this staff member? This will delete their login user account as well.');" 
                  class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 font-bold px-3 py-1.5 rounded-xl transition-all duration-150">
                    Remove
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="p-8 text-center text-stone-400 text-sm">
            No staff members found starting with that name.
        </td>
    </tr>
@endforelse