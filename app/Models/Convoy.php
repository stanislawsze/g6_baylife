<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Convoy extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'is_started', 'is_finished', 'user_id', 'convoy_amount', 'start_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'is_started' => 'boolean',
        'is_finished' => 'boolean',
        'user_id' => 'integer',
        'convoy_amount' => 'integer',
        'start_at' => 'datetime:Y-m-d H:i'
    ];

    /**
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(ConvoyVehicle::class);
    }

    public function userVehicle($userID)
    {
        return $this->hasOne(ConvoyVehicle::class)->where('user_id', $userID)->first();
    }

    /**
     * @return HasMany
     */
    public function cancellation(): HasMany
    {
        return $this->hasMany(ConvoyUserCancellationReason::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function config()
    {
        return $this->hasMany(ConvoyConfig::class)->orderBy('position');
    }
    /**
     * @param $query
     * @param $column
     * @return mixed
     */
    static public function search($query, $column): mixed
    {
        if($query != null or $query != '')
        {
            return self::where($column, 'LIKE', '%'.$query.'%');
        }
        else
        {
            return self::orderBy('id', 'ASC');
        }
    }
}
