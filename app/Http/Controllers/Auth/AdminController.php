<?php
// App\Http\Controllers\AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware sprawdzający, czy użytkownik jest zalogowany i ma rolę admin
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->isAdmin()) {
                return $next($request);
            }
            return response()->json(['error' => 'Brak dostępu'], 403);
        });
    }

    // Panel admina
    public function adminPanel()
    {
        return view('admin.panel'); // Przykładowy widok dla admina
    }
}
?>