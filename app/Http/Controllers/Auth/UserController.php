<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    // Usuwanie użytkownika
    public function destroy(User $user)
    {
        // Sprawdzamy, czy użytkownik jest administratorem
        if (auth()->user()->isAdmin()) {
            // Admin nie może usunąć samego siebie
            if (auth()->id() === $user->id) {
                return redirect()->route('admin.users.index')->with('error', 'Nie możesz usunąć samego siebie.');
            }

            // Usuwamy użytkownika i związane z nim dane, jeśli istnieją (np. pracownik)
            if ($user->role === 'worker') {
                $worker = Worker::where('user_id', $user->id)->first();
                if ($worker) {
                    $worker->delete(); // Usuwamy dane pracownika
                }
            }

            // Usuwamy użytkownika
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'Użytkownik został usunięty.');
        }

        return redirect()->route('admin.users.index')->with('error', 'Brak uprawnień do wykonania tej operacji.');
    }

    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
    
        // Return a view or JSON response with the users
        return view('admin.users.index', compact('users')); // If using a Blade view
        // Or return response()->json($users); // If returning JSON
    }

}

