<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with('user');

        // Handle search functionality
        if ($request->has('search') && $request->search !== null) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        $reviews = $query->latest()->paginate(10)->appends(['search' => $request->search]);
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function update(Request $request, Review $review)
    {
        // Ensure the logged-in user is authorized to update the review
        $this->authorize('update', $review);

        $request->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update([
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        // Allow only admins to delete reviews
        if (auth()->user()->isAdmin()) {
            $review->delete();
            return redirect()->back()->with('success', 'Review deleted successfully.');
        }

        abort(403, 'Unauthorized action.');
    }
}
