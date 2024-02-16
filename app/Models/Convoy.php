<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convoy extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'is_started', 'is_finished', 'user_id', 'convoy_amount', 'starts_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'is_started' => 'boolean',
        'is_finished' => 'boolean',
        'user_id' => 'integer',
        'convoy_amount' => 'integer',
        'starts_at' => 'datetime:Y-m-d H:i'
    ];

    public function vehicles()
    {
        return $this->hasMany(ConvoyVehicle::class);
    }

    public function cancellation()
    {
        return $this->hasMany(ConvoyUserCancellationReason::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
