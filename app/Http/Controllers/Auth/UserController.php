<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Rejestracja nowego użytkownika
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,worker', // Rola może być 'user' lub 'worker'
        ]);

        // Tworzymy użytkownika
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        // Jeśli rola to 'worker', dodajemy pracownika do tabeli 'workers'
        if ($user->role === 'worker') {
            Worker::create([
                'user_id' => $user->id,
                'worker_id' => 'worker-' . $user->id, // Możesz dostosować sposób generowania worker_id
                'job_title' => 'Pracownik', // Przykładowy tytuł pracy, możesz to zmienić
            ]);
        }

        return response()->json(['message' => 'Użytkownik zarejestrowany'], 201);
    }
}
