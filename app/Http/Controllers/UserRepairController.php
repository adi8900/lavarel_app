<?php

namespace App\Http\Controllers;

use App\Models\Repair;

class UserRepairController extends Controller
{
    public function index()
    {
        // Pobierz naprawy przypisane do zalogowanego użytkownika
        $repairs = Repair::where('assigned_to', auth()->id())->get();
        return view('repairs.index', compact('repairs'));
    }
}

