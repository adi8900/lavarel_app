@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reviews</h1>

    <!-- Formularz wyszukiwania -->
    <form action="{{ route('reviews.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" 
                   placeholder="Search reviews..." 
                   value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @auth
        <form action="{{ route('reviews.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="content">Your Review:</label>
                <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="form-control" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> to leave a review.</p>
    @endauth

    <!-- Wyświetlanie recenzji -->
    @foreach ($reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $review->user->name }} - {{ $review->rating }} Stars</h5>
                <p class="card-text">{{ $review->content }}</p>
                <p class="text-muted">Posted on {{ $review->created_at->format('d M Y, H:i') }}</p>

                @if (auth()->check() && auth()->user()->isAdmin())
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    <!-- Paginacja -->
    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
