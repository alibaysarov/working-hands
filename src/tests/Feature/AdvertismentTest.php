<?php

namespace Tests\Feature;

use App\Models\Advertisment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertismentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function testGetAllAdvertisments()
    {
        $response = $this->get('/api/advertisment/all');
        $response->assertStatus(200);
    }

    public function testCreateAdvertisment()
    {
        $data = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'main_cover' => $this->faker->url,
            'price' => $this->faker->randomNumber(2),
            'links' => [$this->faker->url, $this->faker->url], // You can adjust the number of links as needed
        ];

        $response = $this->post('/api/advertisment/create', $data);
        $response->assertStatus(201);
    }
}
