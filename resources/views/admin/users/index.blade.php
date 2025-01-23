@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Zarządzanie użytkownikami</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Imię</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if (auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
