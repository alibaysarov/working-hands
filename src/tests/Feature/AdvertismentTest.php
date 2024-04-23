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
        // Add more assertions based on the expected response structure
    }
}
