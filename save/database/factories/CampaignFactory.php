<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Auth;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'description' => $this->faker->sentence,
            'owner_id' => 1,
            'template_id' => null,
            'status' => true,
        ];
    }
}
