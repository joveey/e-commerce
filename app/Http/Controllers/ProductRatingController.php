<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);

        // Check if user has already rated this product for this order
        $existingRating = ProductRating::where([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'order_id' => $validated['order_id']
        ])->first();

        if ($existingRating) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan rating untuk produk ini.'
            ]);
        }

        // Create the rating
        ProductRating::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'order_id' => $validated['order_id'],
            'rating' => $validated['rating'],
            'review' => $validated['review']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas ulasan Anda!'
        ]);
    }

    public function clearRatingSession()
    {
        session()->forget('rating_items');
        return response()->json(['success' => true]);
    }
}