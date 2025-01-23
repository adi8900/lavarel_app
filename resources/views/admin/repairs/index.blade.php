@extends('layouts.app')

@section('title', 'Repairs Management')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Repairs Management</h1>
        <!-- Button to create a new repair -->
        <a href="{{ route('repairs.create') }}" class="btn btn-primary">Create Repair</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Device</th>
                <th>Status</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($repairs as $repair)
                <tr>
                    <td>{{ $repair->id }}</td>
                    <td>{{ $repair->device->name ?? 'N/A' }}</td>
                    <td>{{ $repair->status->name ?? 'N/A' }}</td>
                    <td>{{ $repair->description }}</td>
                    <td>{{ $repair->cost }}</td>
                    <td>
                        <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this repair?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No repairs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $repairs->links() }}
    </div>
</div>
@endsection
