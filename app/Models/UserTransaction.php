<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 
        'user_id', 
        'before',
        'amount', 
        'after',
        'status',
    ];

    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  Carbon::parse($value)->tz('Asia/Yangon')->format('d-m-Y, g:i:s A'),
        );
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterDates($query)
    {
        $date = explode(' - ', request()->input('date_range', ''));
        if (count($date) != 2) {
            $date = [now()->today()->format('Y-m-d'), now()->format('Y-m-d')];
        }

        return $query->whereBetween('created_at', [$date['0'].' 00:00:00', $date['1'].' 23:59:59']);
    }
}
