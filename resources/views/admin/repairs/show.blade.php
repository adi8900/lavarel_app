@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Repair Details</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Device:</strong> {{ $repair->device->name ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $repair->status->name ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Description:</strong> {{ $repair->description }}</li>
        <li class="list-group-item"><strong>Cost:</strong> ${{ $repair->cost }}</li>
    </ul>

    <a href="{{ route('repairs.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection