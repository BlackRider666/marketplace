<?php

namespace Database\Factories\CompanyCategory;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyCategory\CompanyCategory>
 */
class CompanyCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  =>  $this->faker->companySuffix(),
        ];
    }
}
