<?php

namespace App\Http\Controllers;

use App\Models\CustomerPhoto;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = CustomerPhoto::where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->paginate(24);

        return view('pages.gallery', compact('photos'));
    }
}
