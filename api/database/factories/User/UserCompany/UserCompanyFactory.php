<?php

namespace Database\Factories\User\UserCompany;

use App\Models\CompanyCategory\CompanyCategory;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\UserCompany\UserCompany>
 */
class UserCompanyFactory extends Factory
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
            'code'      =>  $this->faker->companySuffix(),
            'site'      =>  $this->faker->url(),
            'contact_person'    =>  $this->faker->name(),
            'company_category_id' => CompanyCategory::factory(),
            'desc'                => $this->faker->realText(),
        ];
    }
}
