<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class AdminStaffController extends Controller
{

    public function index()
    {

        $staff = Staff::with('user')
            ->latest()
            ->get();


        return view('admin.staff.index', compact('staff'));

    }

}