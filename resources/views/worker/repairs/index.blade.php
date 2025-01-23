@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Twoje naprawy</h1>

        <!-- Add the button to navigate to the create repair page -->
        <a href="{{ route('worker.repairs.create') }}" class="btn btn-primary mb-3">Dodaj Naprawę</a>

        @if ($repairs->isEmpty())
            <p>Brak przydzielonych napraw.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Urządzenie</th>
                        <th>Status</th>
                        <th>Szczegóły</th>
                        <th>Koszt</th>
                        <th>Akcje</th> <!-- Added column for actions -->
                    </tr>
                </thead>
                <tbody>
                @foreach ($repairs as $repair)
<tr>
    <td>{{ $repair->device->name ?? 'N/A' }}</td>
    <td>{{ $repair->status->name ?? 'N/A' }}</td>
    <td>{{ $repair->description }}</td>
    <td>{{ $repair->cost }}</td>
    <td>
        <!-- Edit button -->
        <a href="{{ route('worker.repairs.edit', $repair->id) }}" class="btn btn-warning">Edit</a>

        <!-- Delete button with confirmation -->
        <form action="{{ route('worker.repairs.destroy', $repair->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this repair?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach

                </tbody>
            </table>
        @endif
    </div>
@endsection
