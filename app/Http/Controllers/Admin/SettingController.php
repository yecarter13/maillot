<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => SiteSetting::getValue('site_name', 'Le Maillot Idéal'),
            'slogan' => SiteSetting::getValue('slogan', 'Porte ta passion.'),
            'whatsapp_number' => SiteSetting::getValue('whatsapp_number', ''),
            'delivery_info' => SiteSetting::getValue('delivery_info', 'Livraison partout au Cameroun'),
            'hero_title' => SiteSetting::getValue('hero_title', 'Les Maillots de Vos Clubs Préférés'),
            'hero_subtitle' => SiteSetting::getValue('hero_subtitle', 'Commandez vos maillots officiels et fidèles sur WhatsApp. Livraison partout au Cameroun.'),
            'hero_image' => SiteSetting::getValue('hero_image', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:50',
            'delivery_info' => 'nullable|string|max:500',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_image' => 'nullable|string|max:500',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::setValue($key, $value ?? '');
        }

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres enregistrés avec succès.');
    }
}
