<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clear(Request $request)
    {
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        Artisan::call('optimize:clear');

        return back()->with('success', 'Cache vidé. Les dernières modifications sont maintenant actives.');
    }
}
