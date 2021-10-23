<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_article_index()
    {
        auth()->login(User::find(1));
        
        $response = $this->get('/api/index');

        $response->assertStatus(200);
    }
}
