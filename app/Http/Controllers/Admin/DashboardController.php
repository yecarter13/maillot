<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championship;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'activeProducts' => Product::where('is_active', true)->count(),
            'championships' => Championship::count(),
            'admins' => User::where('is_admin', true)->count(),
        ];

        $recentProducts = Product::with('championship')->latest()->take(8)->get();

        return view('admin.dashboard.index', compact('stats', 'recentProducts'));
    }
}
