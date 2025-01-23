@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reviews</h1>

    <!-- Search Form -->
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

    <!-- Display Reviews -->
    @foreach ($reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $review->user->name }} - {{ $review->rating }} Stars</h5>
                <p class="card-text">{{ $review->content }}</p>
                <p class="text-muted">Posted on {{ $review->created_at->format('d M Y, H:i') }}</p>

                @auth
                    @if (auth()->id() === $review->user_id)
                        <!-- Edit Button -->
                        <button class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $review->id }})">
                            Edit
                        </button>
                        
                        <!-- Edit Form -->
                        <form action="{{ route('reviews.update', $review) }}" method="POST" 
                              id="edit-form-{{ $review->id }}" 
                              style="display: none;" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="content-{{ $review->id }}">Edit Review:</label>
                                <textarea name="content" id="content-{{ $review->id }}" rows="3" 
                                          class="form-control" required>{{ $review->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="rating-{{ $review->id }}">Rating:</label>
                                <select name="rating" id="rating-{{ $review->id }}" 
                                        class="form-control" required>
                                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Good</option>
                                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Average</option>
                                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Poor</option>
                                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Terrible</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Update Review</button>
                        </form>
                    @endif

                    @if (auth()->user()->isAdmin())
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    function toggleEditForm(reviewId) {
        const form = document.getElementById(`edit-form-${reviewId}`);
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endsection