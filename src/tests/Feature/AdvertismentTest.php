<?php

namespace Tests\Feature;

use App\Models\Advertisment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertismentTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    public function testGetAllAdvertisments()
    {
        $response = $this->get('/api/advertisment/all');
        $response->assertStatus(200);
    }
    public function testGetSingleAdvertisment()
    {
        $advertisment = Advertisment::factory()->create();
        $hasField = boolval(random_int(0,1));
        if($hasField) {
            $response = $this->get('/api/advertisment/' . $advertisment->id."?fields=true");
            $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'description',
                'price',
                'main_cover',
                'links',
                'deleted_at',
                'created_at',
                'updated_at'
            ]);
        } else {
            $response = $this->get('/api/advertisment/' . $advertisment->id."?fields=true");
            $response->assertStatus(200)->assertJsonStructure([
                'id',
                'name',
                'price',
                'main_cover']);
        }

    }
    public function testCreateAdvertisment()
    {
        $data = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'main_cover' => $this->faker->url,
            'price' => $this->faker->randomNumber(2),
            'links' => [$this->faker->url, $this->faker->url],
        ];

        $response = $this->post('/api/advertisment/create', $data);
        $response->assertStatus(201);
    }
}
