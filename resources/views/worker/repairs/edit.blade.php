@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edytuj naprawę</h1>
    <form action="{{ route('worker.repairs.update', $repair->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="device" class="form-label">Urządzenie</label>
            <input type="text" name="device" id="device" class="form-control" value="{{ $repair->device }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $repair->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>
@endsection