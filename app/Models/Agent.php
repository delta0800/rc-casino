<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'agent';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 
        'master_id', 
        'username', 
        'amount', 
        'banned_till', 
        'password', 
        'percentage', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) =>  Hash::make($value),
        );
    }

    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  Carbon::parse($value)->tz('Asia/Yangon')->format('d-m-Y, g:i:s A'),
        );
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeCountusers($query){
        return $query->count();
    }

    public function scopeSumusers($query){
        return $query->sum('amount');
    }
}
