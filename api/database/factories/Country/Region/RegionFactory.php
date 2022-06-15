<?php

namespace Database\Factories\Country\Region;

use App\Models\Country\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country\Region\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  =>  $this->faker->citySuffix(),
            'country_id'    => Country::factory(),
        ];
    }
}
