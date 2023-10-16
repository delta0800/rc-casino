<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Senior extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'senior';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 
        'super_id', 
        'username', 
        'amount', 
        'banned_till', 
        'password', 
        'percentage', 
        'password_changed_at'
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
            get: fn ($value) =>  Carbon::parse($value)->format('d-m-Y, g:i:s A'),
        );
    }

    public function super()
    {
        return $this->belongsTo(Super::class);
    }

    public function masters()
    {
        return $this->hasMany(Master::class);
    }

    public function scopeCountusers($query){
        return $query->count();
    }

    public function scopeSumusers($query){
        return $query->sum('amount');
    }
}
