<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('globalSite', (object) [
                'name' => SiteSetting::getValue('site_name', 'Le Maillot Idéal'),
                'slogan' => SiteSetting::getValue('slogan', 'Porte ta passion.'),
                'whatsapp' => SiteSetting::getValue('whatsapp_number', ''),
                'deliveryInfo' => SiteSetting::getValue('delivery_info', 'Livraison partout au Cameroun'),
            ]);
        });
    }
}
