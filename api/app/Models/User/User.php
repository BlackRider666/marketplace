<?php

namespace App\Models\User;

use App\Models\User\UserAccount\UserAccount;
use App\Models\User\UserCompany\UserCompany;
use App\Models\User\UserLocale\UserLocale;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'surname',
        'email',
        'phone',
        'password',
        'file',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function locale(): HasOne
    {
        return $this->hasOne(UserLocale::class);
    }

    /**
     * @return HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(UserAccount::class);
    }

    /**
     * @return HasOne
     */
    public function company(): HasOne
    {
        return $this->hasOne(UserCompany::class);
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->hasRole('simple');
    }

    /**
     * @return bool
     */
    public function isCompany(): bool
    {
        return $this->hasRole('company');
    }
}
