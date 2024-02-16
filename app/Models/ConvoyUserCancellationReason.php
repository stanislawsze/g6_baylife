<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvoyUserCancellationReason extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'convoy_id', 'user_id', 'cancellation_reason'
    ];

    protected $casts = [
        'id' => 'integer',
        'convoy_id' => 'integer',
        'user_id' => 'integer',
        'cancellation_reason' => 'string'
    ];

    public function convoy()
    {
        return $this->belongsTo(Convoy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
