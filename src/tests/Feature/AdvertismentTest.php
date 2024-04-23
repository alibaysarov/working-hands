<?php

namespace Tests\Feature;

use App\Models\Advertisment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertismentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/advertisment/all');
        $response->assertStatus(200);
        $this->assertEquals(13,count($response->json()));
    }
}
