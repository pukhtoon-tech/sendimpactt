<?php

namespace Database\Factories;

use App\Models\EmailContact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Auth;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'owner_id' => 1,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'favourites' => 0,
            'blocked' => 0,
        ];
    }
}
