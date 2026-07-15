<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{

    public function index()
    {
        $users = User::whereHas('role', function($q){
            $q->where('name','Customer');
        })
        ->latest()
        ->get();


        return view('admin.users.index', compact('users'));
    }

}