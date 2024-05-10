<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Warning extends Model
{
    use HasFactory;

    protected $fillable = [
         'user_id', 'warning_content', 'giver_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'warning_content' => 'string',
        'giver_id' => 'string'
    ];

    public function giver(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'giver_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
