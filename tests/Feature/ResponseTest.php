<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ArticleResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    function test_login() {
                
        Auth()->login(User::find(1));

        $this->assertTrue(true);
        
        
        
    }
    
    
    
    
    
    public function test_resource()
    {
        auth()->login(User::find(1));
        
        $articlecontroller=new ArticleController();
        $response=$articlecontroller->index();
        $response=json_decode($response->content())->Data;
        
        $this->assertIsArray($response);
        $flag1=false;
        $flag12=false;
        
        
        foreach ($response as $item){
    
            $this->assertArrayHasKey('id',(array)$item);
            $this->assertArrayHasKey('name',(array)$item);
            $this->assertArrayHasKey('basket',(array)$item);
            $this->assertArrayHasKey('favorite',(array)$item);
            
            if(((array)$item)['basket']){
                $flag1=true;
            }
            if(((array)$item)['favorite']){
                $flag2=true;
            }
    
            $this->assertArrayHasKey('entity',(array)$item);
            $this->assertArrayHasKey('created_at',(array)$item);
            $this->assertArrayHasKey('updated_at',(array)$item);
        
        }
        
        if(!$flag1)$this->assertTrue(false);
        if(!$flag2)$this->assertTrue(false);
       
      
    }
}
