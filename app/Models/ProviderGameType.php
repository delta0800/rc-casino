<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderGameType extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_provider_id',
        'game_type_id',
    ];

    public function providers()
    {
        return $this->belongsToMany(GameProvider::class, 'provider_game_types');
    }
}
