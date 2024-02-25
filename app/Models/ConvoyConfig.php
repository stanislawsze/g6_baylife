<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvoyConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'convoy_id', 'vehicle_id', 'is_stockade', 'is_nightshark', 'is_u2r', 'position'
    ];

    protected $casts = [
        'id' => 'integer',
        'convoy_id' => 'integer',
        'vehicle_id' => 'integer',
        'is_stockade' => 'boolean',
        'is_nightshark' => 'boolean',
        'is_u2r' => 'boolean',
        'position' => 'integer'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getUserFromVehicle()
    {
        return $this->hasMany(ConvoyVehicle::class, 'convoy_id', 'convoy_id')->where('vehicle_id', $this->vehicle_id);
    }
}
