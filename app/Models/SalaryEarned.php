<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SalaryEarned extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary', 'convoy_id', 'user_id', 'id', 'going_on_duty_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'convoy_id' => 'integer',
        'user_id' => 'integer',
        'salary' => 'integer',
        'going_on_duty_id' => 'integer',
    ];

    public function duty()
    {
        return $this->belongsTo(GoingOnDuty::class);
    }

    public function convoy(): BelongsTo
    {
        return $this->belongsTo(Convoy::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function salaries($userId): int
    {
        return (int) self::where('user_id', $userId)->sum('salary');
    }

}
