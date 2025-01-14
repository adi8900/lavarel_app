@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Logowanie</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zaloguj się</button>
            </div>
        </form>
    </div>
@endsection
