<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    
    protected $fillable = [
        'user_id',
        'year',
        'month',
        'type',
        'notes',
        'monthly_amount',
        'annual_amount',
        'percentage_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
