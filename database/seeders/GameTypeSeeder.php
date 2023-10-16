<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GameType;

class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $img = "no-image-icon-6.png";
        $game_types = [
            [
                'code' => 'CB',
                'name'  => 'CARD & BOARDGAME',
                'img'  => $img,
            ],
            [
                'code' => 'ES',
                'name'  => 'E-GAMES',
                'img'  => $img,
            ],
            [
                'code' => 'SB',
                'name'  => 'SPORTBOOK',
                'img'  => $img,
            ],
            [
                'code' => 'LC',
                'name'  => 'LIVE-CASINO',
                'img'  => $img,
            ],
            [
                'code' => 'SL',
                'name'  => 'SLOTS',
                'img'  => $img,
            ],
            [
                'code' => 'LK',
                'name'  => 'LOTTO',
                'img'  => $img,
            ],
            [
                'code' => 'FH',
                'name'  => 'FISH HUNTER',
                'img'  => $img,
            ],
            [
                'code' => 'PK',
                'name'  => 'POKER',
                'img'  => $img,
            ],
            [
                'code' => 'MG',
                'name'  => 'MINI GAME',
                'img'  => $img,
            ],
            [
                'code' => 'OT',
                'name'  => 'OTHERS',
                'img'  => $img,
            ]
        ];

        foreach($game_types as $type){
            GameType::create($type);
        }
    }
}
