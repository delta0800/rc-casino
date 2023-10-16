<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GameProvider;

class GameProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $img = "no-image-icon-6.png";
        $game_providers = [
            [
                'code' => 'G8',
                'name'  => 'GAMEPLAY',
                'img'  => $img,
            ],
            [
                'code' => 'IB',
                'name'  => 'IBC',
                'img'  => $img,
            ],
            [
                'code' => 'JD',
                'name'  => 'JDB',
                'img'  => $img,
            ],
            [
                'code' => 'JK',
                'name'  => 'JOKER',
                'img'  => $img,
            ],
            [
                'code' => 'WB',
                'name'  => 'WBET',
                'img'  => $img,
            ],
            [
                'code' => 'P3',
                'name'  => 'NETENT',
                'img'  => $img,
            ],
            [
                'code' => 'E0',
                'name'  => 'EVOLUTION',
                'img'  => $img,
            ],
            [
                'code' => 'FK',
                'name'  => 'FUNKYGAME',
                'img'  => $img,
            ],
            [
                'code' => 'QT',
                'name'  => 'QTECH',
                'img'  => $img,
            ],
            [
                'code' => 'WC',
                'name'  => 'WMCASINO',
                'img'  => $img,
            ],
            [
                'code' => 'YL',
                'name'  => 'YLGAMING',
                'img'  => $img,
            ],
            [
                'code' => 'CQ',
                'name'  => 'CQ9',
                'img'  => $img,
            ],
            [
                'code' => 'SG',
                'name'  => 'SPADEGAMING',
                'img'  => $img,
            ],
            [
                'code' => 'JJ',
                'name'  => 'JILI',
                'img'  => $img,
            ],
        ];

        foreach($game_providers as $provider){
            GameProvider::create($provider);
        }
    }
}
