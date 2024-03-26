<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jakyeru\Larascord\Traits\InteractsWithDiscord;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithDiscord;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'username',
        'global_name',
        'discriminator',
        'email',
        'avatar',
        'verified',
        'banner',
        'banner_color',
        'accent_color',
        'locale',
        'mfa_enabled',
        'premium_type',
        'public_flags',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'global_name' => 'string',
        'discriminator' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'verified' => 'boolean',
        'banner' => 'string',
        'banner_color' => 'string',
        'accent_color' => 'string',
        'locale' => 'string',
        'mfa_enabled' => 'boolean',
        'premium_type' => 'integer',
        'public_flags' => 'integer',
        'roles' => 'json',
    ];

    /**
     * @return HasMany
     */
    public function duties(): HasMany
    {
        return $this->hasMany(GoingOnDuty::class);
    }

    /**
     * @return BelongsToMany
     */
    public function convoys(): BelongsToMany
    {
        return $this->belongsToMany(Convoy::class);
    }

    /**
     * @param $id
     * @return bool
     */
    public function hasEntryInConvoyTable($id): bool
    {
        return $this->convoys()->where('convoy_id', $id)->exists();
    }

    /**
     * @return HasMany
     */
    public function convoyCancellation(): HasMany
    {
        return $this->hasMany(ConvoyUserCancellationReason::class);
    }

    /**
     * @param $id
     * @return Model|HasOne|null
     */
    public function getCurrentConvoyCancellation($id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasOne|null
    {
        return $this->hasOne(ConvoyUserCancellationReason::class)->where([['user_id', $this->id], ['convoy_id', $id]])->first();
    }

    /**
     * @return HasOne
     */
    public function getRole(): HasOne
    {
        return $this->hasOne(DiscordUserRole::class);
    }

    /**
     * @param $convoyId
     * @return int
     */
    public function salary($convoyId): int
    {
        return (int) SalaryEarned::where([['convoy_id', $convoyId], ['user_id', $this->id]])->sum('salary');
    }

    /**
     * @return int
     */
    public function salaries(): int
    {
        return (int) SalaryEarned::where('user_id', $this->id)->sum('salary');
    }

    /**
     * @return int
     */
    public function convoySalaries(): int
    {
        return (int) SalaryEarned::where('user_id', $this->id)->whereNotNull('convoy_id')->sum('salary');
    }

    /**
     * @return int
     */
    public function dutySalary(): int
    {
        return (int) SalaryEarned::where('user_id', $this->id)->whereNotNull('going_on_duty_id')->sum('salary');
    }

    public function dutyPatrolSalary(): int
    {
        return (int) SalaryEarned::where('user_id', $this->id)->whereIn('going_on_duty_id', $this->duties()->where('service_type', false)->get('id')->toArray())->sum('salary');
    }

    /**
     * @param $convoyId
     * @return void
     */
    public function addEntryToConvoyTable($convoyId): void
    {
        $this->convoys()->attach($convoyId);
    }
}
