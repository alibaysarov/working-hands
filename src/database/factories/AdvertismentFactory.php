<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisment>
 */
class AdvertismentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->numberBetween(100, 10000),
            'main_cover' => $this->faker->imageUrl(),
            'links' => json_encode([
                'link1' => $this->faker->url,
                'link2' => $this->faker->url,
                'link3' => $this->faker->url,
            ]),
        ];
    }
}
