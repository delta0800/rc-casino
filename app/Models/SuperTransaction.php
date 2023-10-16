<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SuperTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'super_id',
        'before', 
        'amount', 
        'after', 
        'status',
    ];

    public function scopeWithdrawals($query){
        return $query->whereStatus('withdrawal')
                    ->whereDate('created_at', now()->today())
                    ->sum('amount');
    }

    public function scopeDeposits($query){
        return $query->whereStatus('deposit')
                    ->whereDate('created_at', now()->today())
                    ->sum('amount');
    }

    public function scopeFilterDates($query)
    {
        $date = explode(' - ', request()->input('date_range', ''));
        if (count($date) != 2) {
            $date = [now()->today()->format('Y-m-d'), now()->format('Y-m-d')];
        }

        return $query->whereBetween('created_at', [$date['0'].' 00:00:00', $date['1'].' 23:59:59']);
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
}
