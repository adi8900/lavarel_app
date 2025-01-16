<!-- resources/views/worker/repairs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Repairs</h1>

        @if ($repairs->isEmpty())
            <p>You have no repairs assigned.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($repairs as $repair)
                        <tr>
                            <td>{{ $repair->device->name ?? 'N/A' }}</td>
                            <td>{{ $repair->status->name ?? 'N/A' }}</td>
                            <td>{{ $repair->description }}</td>
                            <td>{{ $repair->cost }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection