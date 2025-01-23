@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dodaj nową naprawę</h1>
    <form action="{{ route('worker.repairs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="device" class="form-label">Urządzenie</label>
            <input type="text" name="device" id="device" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Zapisz</button>
    </form>
</div>
@endsection