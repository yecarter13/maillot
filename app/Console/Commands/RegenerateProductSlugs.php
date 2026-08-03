<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class RegenerateProductSlugs extends Command
{
    protected $signature = 'products:regenerate-slugs';

    protected $description = 'Régénère le lien (slug) de chaque maillot à partir de son nom';

    public function handle(): int
    {
        foreach (Product::query()->orderBy('id')->get() as $product) {
            $product->slug = Product::uniqueSlug($product->name, $product->id);
            $product->saveQuietly();
            $this->line($product->slug . '  <=  ' . $product->name);
        }

        $this->info('Les liens de tous les maillots ont été régénérés.');

        return self::SUCCESS;
    }
}