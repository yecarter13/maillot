<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\CustomerPhoto;
use App\Models\Product;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $championships = Championship::withCount('products')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->filter(fn ($c) => $c->products_count > 0)
            ->values();

        $newArrivals = Product::with('championship')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $featured = Product::with('championship')
            ->where('is_active', true)
            ->where('is_new', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $heroTitle = SiteSetting::getValue('hero_title', 'Les Maillots de Vos Clubs Préférés');
        $heroSubtitle = SiteSetting::getValue('hero_subtitle', 'Commandez vos maillots officiels et fidèles sur WhatsApp. Livraison partout au Cameroun.');
        $heroImage = SiteSetting::getValue('hero_image', '/hero.png');
        if (file_exists(public_path('hero.png')) || file_exists(base_path('public/hero.png'))) {
            $heroImage = '/hero.png';
        }

        $customerPhotos = CustomerPhoto::where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $testimonials = [
            (object) ['name' => 'Jean-Pierre Ndongo', 'location' => 'Douala', 'rating' => 5, 'text' => 'Maillot reçu en 3 jours à Douala, qualité top et exactement comme sur la photo. Je recommande Le Maillot Idéal !'],
            (object) ['name' => 'Aline Mbarga', 'location' => 'Yaoundé', 'rating' => 5, 'text' => 'Commande passée sur WhatsApp, réponse rapide et livraison impeccable. Mon fils adore son maillot du Real Madrid.'],
            (object) ['name' => 'Serge Kamdem', 'location' => 'Bafoussam', 'rating' => 4, 'text' => 'Très bon service, paiement à la livraison. Les tailles sont fidèles. Je reviendrai.'],
            (object) ['name' => 'Marie Claire Fouda', 'location' => 'Garoua', 'rating' => 5, 'text' => 'Excellente boutique en ligne. Le maillot des Lions Indomptables est magnifique. Livraison rapide même à Garoua.'],
        ];

        return view('pages.home', compact(
            'championships',
            'newArrivals',
            'featured',
            'heroTitle',
            'heroSubtitle',
            'heroImage',
            'testimonials',
            'customerPhotos'
        ));
    }
}
