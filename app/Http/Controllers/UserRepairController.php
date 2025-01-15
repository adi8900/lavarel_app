<?php

namespace App\Http\Controllers;

use App\Models\Repair;

class UserRepairController extends Controller
{
    public function index()
    {
        // Eager load 'device' and 'status' relationships for performance optimization
        $repairs = Repair::with(['device', 'status'])
                         ->where('assigned_to', auth()->id()) // Get repairs assigned to the logged-in user
                         ->get();     

        return view('repairs.index', compact('repairs'));
    }
}

