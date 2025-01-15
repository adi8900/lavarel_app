@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Repair</h1>

    <form method="POST" action="{{ route('repairs.update', $repair) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="device_id" class="form-label">Device</label>
            <select name="device_id" id="device_id" class="form-select">
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ $repair->device_id == $device->id ? 'selected' : '' }}>
                        {{ $device->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" id="status_id" class="form-select">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $repair->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $repair->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" name="cost" id="cost" class="form-control" value="{{ $repair->cost }}" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
