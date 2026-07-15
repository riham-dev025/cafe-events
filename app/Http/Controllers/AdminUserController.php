<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        // 1. Start with our base Customer query
        $query = User::whereHas('role', function($q){
            $q->where('name', 'Customer');
        });

        // 2. Filter by Search Name (Starts-With Case-Insensitive)
        if ($request->filled('search')) {
            $searchTerm = trim(strtolower($request->search)) . '%';
            $query->whereRaw('LOWER(name) LIKE ?', [$searchTerm]);
        }

        $users = $query->latest()->get();

        // 3. If it's an AJAX request, return only the table body partial
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.table-rows', compact('users'))->render()
            ]);
        }

        return view('admin.users.index', compact('users'));
    
    }

}