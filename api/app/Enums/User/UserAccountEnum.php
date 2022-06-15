<?php


namespace App\Enums\User;


enum UserAccountEnum: string
{
    case Google = 'google';
    case Facebook = 'facebook';
    case Instagram = 'instagram';
}
