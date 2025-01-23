@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edytuj naprawę</h1>

        <form action="{{ route('worker.repairs.update', $repair) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="device_id">Urządzenie</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}" {{ $repair->device_id == $device->id ? 'selected' : '' }}>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status_id">Status</label>
                <select name="status_id" id="status_id" class="form-control" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $repair->status_id == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Szczegóły</label>
                <textarea name="description" id="description" class="form-control" required>{{ $repair->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="cost">Koszt</label>
                <input type="number" name="cost" id="cost" class="form-control" value="{{ $repair->cost }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Zaktualizuj</button>
        </form>
    </div>
@endsection