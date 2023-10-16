<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SeniorTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'senior_id', 
        'super_id',
        'before', 
        'amount', 
        'after', 
        'status',
    ];

    public function senior()
    {
        return $this->belongsTo(Senior::class);
    }

    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  Carbon::parse($value)->tz('Asia/Yangon')->format('d-m-Y, g:i:s A'),
        );
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
