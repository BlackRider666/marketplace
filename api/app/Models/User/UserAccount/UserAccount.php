<?php

namespace App\Models\User\UserAccount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\User\UserAccountEnum;

class UserAccount extends Model
{
    use HasFactory;

    protected $casts = [
        'provider' => UserAccountEnum::class
    ];
}
