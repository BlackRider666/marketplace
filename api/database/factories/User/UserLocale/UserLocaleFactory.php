<?php

namespace Database\Factories\User\UserLocale;

use App\Models\Country\Country;
use App\Models\Country\Region\City\City;
use App\Models\Country\Region\Region;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\UserLocale\UserLocale>
 */
class UserLocaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   =>  User::factory(),
            'country_id'    =>  Country::factory(),
            'region_id'     =>  Region::factory(),
            'city_id'       =>  City::factory(),
            'address'       =>  $this->faker->address(),
        ];
    }
}
