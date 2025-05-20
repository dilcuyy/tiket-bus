<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Kontak::latest()->paginate(10); // ambil dari tabel kontak
        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = Kontak::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.review.index')->with('success', 'Review berhasil dihapus.');
    }
}
