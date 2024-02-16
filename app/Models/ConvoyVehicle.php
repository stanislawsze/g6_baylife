<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvoyVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'convoy_id', 'vehicle_id', 'user_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'convoy_id' => 'integer',
        'vehicle_id' => 'integer',
        'user_id' => 'integer'
    ];

    public function convoy()
    {
        return $this->belongsTo(Convoy::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
