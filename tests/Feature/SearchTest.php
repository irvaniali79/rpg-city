<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\SearchController;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_search()
    {
        $SearchController=new SearchController();
        $result=$SearchController->__invoke(new SearchRequest(['model'=>'Article','search'=>'Ardella ']))->content();
   
        $this->assertNotEquals(404,$result);
    }
}
