<?php

namespace Database\Factories\Country\Region\City;

use App\Models\Country\Region\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country\Region\City\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      =>  $this->faker->city(),
            'region_id' => Region::factory(),
        ];
    }
}
