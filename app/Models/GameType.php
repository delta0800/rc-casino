<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'img',
    ];

    public function tag()
    {
        return $this->belongsToMany(GameProvider::class, 'provider_game_types');
    } 
}
