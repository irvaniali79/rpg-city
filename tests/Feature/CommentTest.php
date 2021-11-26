<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CommentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        auth()->login(User::find(3));
        $data=['commentable_id'=>'1','commentable_type'=>'App\\Models\\Article','message'=>'fuck you',
            'advantages'=>json_encode([
                    
                    'hi','best'
                    
                ])];
        $response = $this->post('api/comments',$data);

        $response->assertStatus(200);
    }
    
}
