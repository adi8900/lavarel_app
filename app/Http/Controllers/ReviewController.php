<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->latest()->paginate(10);
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

    public function destroy(Review $review)
    {
        if (auth()->user()->isAdmin()) {
            $review->delete();
            return redirect()->back()->with('success', 'Review deleted successfully.');
        }

        abort(403, 'Unauthorized action.');
    }
}
