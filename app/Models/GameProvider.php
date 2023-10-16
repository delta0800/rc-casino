<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'img',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function tag()
    {
        return $this->belongsToMany(GameType::class, 'provider_game_types');
    } 

    public function scopeStatus($query)
    {
        return $query->whereStatus('0');
    }
}
