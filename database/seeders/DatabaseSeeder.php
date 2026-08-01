<?php

namespace Database\Seeders;

use App\Models\Championship;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->firstOrCreate(
            ['email' => 'admin@fatilstore.com'],
            [
                'name' => 'Administrateur',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        SiteSetting::setValue('site_name', 'Fatil Store');
        SiteSetting::setValue('whatsapp_number', '');
        SiteSetting::setValue('delivery_info', 'Livraison partout au Cameroun');
        SiteSetting::setValue('hero_title', 'Les Maillots de Vos Clubs Préférés');
        SiteSetting::setValue('hero_subtitle', 'Commandez vos maillots officiels et fidèles sur WhatsApp. Paiement à la livraison. Livraison partout au Cameroun.');
        SiteSetting::setValue('hero_image', 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=1920&q=80');

        $championships = [
            ['name' => 'Ligue 1', 'country' => 'France', 'slug' => 'ligue-1'],
            ['name' => 'Premier League', 'country' => 'Angleterre', 'slug' => 'premier-league'],
            ['name' => 'Liga', 'country' => 'Espagne', 'slug' => 'liga'],
            ['name' => 'Serie A', 'country' => 'Italie', 'slug' => 'serie-a'],
            ['name' => 'Bundesliga', 'country' => 'Allemagne', 'slug' => 'bundesliga'],
            ['name' => 'Ligue des Champions', 'country' => 'Europe', 'slug' => 'ligue-des-champions'],
            ['name' => 'Ligue 1 Cameroun', 'country' => 'Cameroun', 'slug' => 'ligue-1-cameroun'],
            ['name' => 'Équipes Nationales', 'country' => 'International', 'slug' => 'equipes-nationales'],
        ];

        $champModels = [];
        foreach ($championships as $i => $c) {
            $champModels[$c['slug']] = Championship::query()->updateOrCreate(
                ['slug' => $c['slug']],
                array_merge($c, ['sort_order' => $i + 1])
            );
        }

        $products = [
            [
                'championship' => 'ligue-1',
                'name' => 'Maillot Domicile Paris Saint-Germain',
                'club' => 'Paris Saint-Germain',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL, XXL',
                'price' => 18000,
                'old_price' => 22000,
                'image' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=800&q=80',
                'description' => "Maillot domicile du Paris Saint-Germain, saison 2025/26. Tissu respirant et confortable, idéal pour le match ou pour la ville. Impression haute qualité, numéro et flocage disponibles sur demande.",
                'is_new' => true,
            ],
            [
                'championship' => 'premier-league',
                'name' => 'Maillot Domicile Manchester City',
                'club' => 'Manchester City',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL',
                'price' => 17000,
                'image' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=800&q=80',
                'description' => 'Maillot domicile des Skyblues pour la saison 2025/26. Coupe athlétique, matière légère et respirante. Disponible dans plusieurs tailles.',
                'is_new' => true,
            ],
            [
                'championship' => 'liga',
                'name' => 'Maillot Domicile Real Madrid',
                'club' => 'Real Madrid',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL, XXL',
                'price' => 18000,
                'image' => 'https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=800&q=80',
                'description' => 'Le maillot mythique des Merengues. Élégance et performance au rendez-vous avec ce maillot domicile de la saison 2025/26.',
                'is_new' => true,
            ],
            [
                'championship' => 'serie-a',
                'name' => 'Maillot Domicile AC Milan',
                'club' => 'AC Milan',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL',
                'price' => 16500,
                'image' => 'https://images.unsplash.com/photo-1606168658465-4d1f42d88be0?w=800&q=80',
                'description' => 'Maillot domicile de l\'AC Milan, les Rossoneri. Rayures emblématiques rouge et noir, matière premium.',
                'is_new' => false,
            ],
            [
                'championship' => 'bundesliga',
                'name' => 'Maillot Domicile Bayern Munich',
                'club' => 'Bayern Munich',
                'season' => '2025/26',
                'sizes' => 'M, L, XL',
                'price' => 16000,
                'image' => 'https://images.unsplash.com/photo-1517927033932-b3d18e61fb3a?w=800&q=80',
                'description' => 'Maillot domicile du Bayern Munich. Rouge traditionnel, tissu de haute qualité pour les supporters les plus fidèles.',
                'is_new' => false,
            ],
            [
                'championship' => 'ligue-des-champions',
                'name' => 'Maillot Extérieur FC Barcelone',
                'club' => 'FC Barcelone',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL, XXL',
                'price' => 17500,
                'old_price' => 20000,
                'image' => 'https://images.unsplash.com/photo-1553778263-73a83bab9b0c?w=800&q=80',
                'description' => 'Maillot extérieur du FC Barcelone pour la campagne européenne 2025/26. Design moderne et confort optimal.',
                'is_new' => true,
            ],
            [
                'championship' => 'ligue-1-cameroun',
                'name' => 'Maillot Domicile Coton Sport de Garoua',
                'club' => 'Coton Sport',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL, XXL',
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?w=800&q=80',
                'description' => 'Soutenez le champion camerounais ! Maillot domicile du Coton Sport de Garoua, fierté du football camerounais.',
                'is_new' => true,
            ],
            [
                'championship' => 'equipes-nationales',
                'name' => 'Maillot Lions Indomptables (Cameroun)',
                'club' => 'Cameroun',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL, XXL',
                'price' => 19000,
                'image' => 'https://images.unsplash.com/photo-1589487391730-58f20e2be308?w=800&q=80',
                'description' => 'Le maillot officiel des Lions Indomptables ! Portez les couleurs du Cameroun avec fierté. Édition spéciale 2025/26.',
                'is_new' => true,
            ],
            [
                'championship' => 'premier-league',
                'name' => 'Maillot Domicile Arsenal',
                'club' => 'Arsenal',
                'season' => '2024/25',
                'sizes' => 'S, M, L, XL',
                'price' => 15500,
                'image' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=800&q=80',
                'description' => 'Maillot domicile des Gunners, le rouge et blanc légendaire d\'Arsenal. Coupe moderne.',
                'is_new' => false,
            ],
            [
                'championship' => 'liga',
                'name' => 'Maillot Domicile Atlético Madrid',
                'club' => 'Atlético Madrid',
                'season' => '2024/25',
                'sizes' => 'M, L, XL',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1578643463396-0997cb5328c1?w=800&q=80',
                'description' => 'Maillot domicile des Colchoneros, rayures rouges et blanches emblématiques.',
                'is_new' => false,
            ],
            [
                'championship' => 'ligue-1',
                'name' => 'Maillot Domicile Olympique de Marseille',
                'club' => 'Olympique de Marseille',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL, XXL',
                'price' => 16500,
                'image' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=800&q=80',
                'description' => 'L\'OM à la maison ! Maillot domicile des Phocéens, bleu ciel et blanc.',
                'is_new' => false,
            ],
            [
                'championship' => 'ligue-1-cameroun',
                'name' => 'Maillot Domicile Union Douala',
                'club' => 'Union Douala',
                'season' => '2025/26',
                'sizes' => 'S, M, L, XL',
                'price' => 11500,
                'image' => 'https://images.unsplash.com/photo-1553778263-73a83bab9b0c?w=800&q=80',
                'description' => 'Le maillot de l\'Union Sportive de Douala. Un classique du football camerounais.',
                'is_new' => false,
            ],
        ];

        foreach ($products as $p) {
            $champ = $champModels[$p['championship']] ?? null;
            $payload = array_merge([
                'championship_id' => $champ?->id,
                'is_active' => true,
                'old_price' => null,
                'description' => null,
                'is_new' => false,
            ], $p);
            unset($payload['championship']);
            Product::query()->updateOrCreate(['name' => $payload['name']], $payload);
        }

        $customerPhotos = [
            [
                'customer_name' => 'Jean-Pierre Ndongo',
                'location' => 'Douala',
                'message' => 'Maillot reçu en 3 jours à Douala, qualité top et exactement comme sur la photo. Je recommande !',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
            ],
            [
                'customer_name' => 'Aline Mbarga',
                'location' => 'Yaoundé',
                'message' => 'Commande passée sur WhatsApp, réponse rapide et livraison impeccable. Mon fils adore son maillot.',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&q=80',
            ],
            [
                'customer_name' => 'Serge Kamdem',
                'location' => 'Bafoussam',
                'message' => 'Très bon service, paiement à la livraison. Les tailles sont fidèles. Je reviendrai.',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&q=80',
            ],
            [
                'customer_name' => 'Marie Claire Fouda',
                'location' => 'Garoua',
                'message' => 'Excellente boutique. Le maillot des Lions Indomptables est magnifique. Livraison rapide même à Garoua.',
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=800&q=80',
            ],
            [
                'customer_name' => 'Franck Manga',
                'location' => 'Kribi',
                'message' => 'Maillot du Barça reçu à Kribi, superbe qualité. Merci Fatil Store !',
                'image' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=800&q=80',
            ],
            [
                'customer_name' => 'Chantal Ngo',
                'location' => 'Limbe',
                'message' => 'Service client au top et maillots de qualité. Commande rapide et soignée.',
                'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=800&q=80',
            ],
        ];

        foreach ($customerPhotos as $i => $cp) {
            \App\Models\CustomerPhoto::query()->updateOrCreate(
                ['customer_name' => $cp['customer_name']],
                array_merge($cp, ['is_active' => true, 'sort_order' => $i + 1])
            );
        }

        $this->command?->info('Admin: admin@fatilstore.com / password');
    }
}
