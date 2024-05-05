<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'phone', 'birthday', 'origines', 'pistol_sn',
        'shotgun_sn', 'torch_sn', 'baton_sn', 'tazer_sn'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'phone' => 'string',
        'birthday' => 'date',
        'origines' => 'string',
        'pistol_sn' => 'string',
        'shotgun_sn' => 'string',
        'torch_sn' => 'string',
        'baton_sn' => 'string',
        'tazer_sn' => 'string'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
