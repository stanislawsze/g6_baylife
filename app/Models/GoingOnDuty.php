<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoingOnDuty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'user_id', 'starts_at', 'stops_at', 'service_type', 'mission', 'salary', 'vehicle_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'starts_at' => 'datetime:Y-m-d H:i:s',
        'stops_at' => 'datetime:Y-m-d H:i:s',
        'service_type' => 'integer',
        'mission' => 'string',
        'salary' => 'integer',
        'vehicle_id' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
