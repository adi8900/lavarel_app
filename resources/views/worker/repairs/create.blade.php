@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj nową naprawę</h1>
    <form action="{{ route('worker.repairs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="device_id" class="form-label">Urządzenie</label>
            <select name="device_id" id="device_id" class="form-control" required>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" id="status_id" class="form-control" required>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Koszt</label>
            <input type="number" name="cost" id="cost" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj naprawę</button>
    </form>
</div>
@endsection
