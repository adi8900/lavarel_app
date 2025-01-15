@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Twoje naprawy</h2>

        @if($repairs->isEmpty())
            <p>Nie masz żadnych napraw.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nazwa urządzenia</th>
                        <th>Status</th>
                        <th>Opis</th>
                        <th>Data zgłoszenia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repairs as $repair)
                        <tr>
                            <td>{{ $repair->id }}</td>
                            <!-- Use brand and model to display device name -->
                            <td>{{ $repair->device->brand . ' ' . $repair->device->model }}</td>
                            <td>{{ $repair->status->name }}</td>
                            <td>{{ $repair->description }}</td>
                            <td>{{ $repair->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection