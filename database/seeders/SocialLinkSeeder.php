<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            ['platform' => 'facebook', 'icon' => 'fa-brands fa-facebook-f', 'url' => '#'],
            ['platform' => 'instagram', 'icon' => 'fa-brands fa-instagram', 'url' => '#'],
            ['platform' => 'twitter', 'icon' => 'fa-brands fa-twitter', 'url' => '#'],
            ['platform' => 'whatsapp', 'icon' => 'fa-brands fa-whatsapp', 'url' => '#'],
            ['platform' => 'youtube', 'icon' => 'fa-brands fa-youtube', 'url' => '#'],
        ];

        foreach ($platforms as $index => $link) {
            SocialLink::query()->create(array_merge($link, [
                'sort_order' => $index + 1,
                'is_active' => true,
            ]));
        }
    }
}
