<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Casts\Jalali;
use App\Models\Article;
use function PHPUnit\Framework\assertInstanceOf;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class JalaliCastTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get()
    {

        $article= Article::find(1);
        $this->assertInstanceOf(Jalalian::class,$article->created_at);
       
    }
    
    public function test_set()
    {
        $article= Article::find(1);
        $article->created_at=Carbon::now();
        $this->assertEquals(Jalalian::now(), $article->created_at);

        
    }
}
