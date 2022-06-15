<?php

namespace Database\Factories\User\UserAccount;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\User\UserAccountEnum;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\UserAccount\UserAccount>
 */
class UserAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'provider' => $this->faker->randomElement([UserAccountEnum::Google, UserAccountEnum::Facebook,UserAccountEnum::Instagram]),
            'account'   =>  $this->faker->url(),
        ];
    }
}
