<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\ArticleController;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Testing\File;

class RequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_article_create() {
        
        auth()->login(User::find(1));
       
        
        Storage::fake('images');
        
        $file=[
            File::create('test-1.jpg',100),
            File::create('test-2.jpg',100)
            
        ];
    
        $data=[
            'article'=>[
                'name'=>'ارتیکل',
                'eng_name'=>'article',
                'price'=>3500,
                'entity'=>3
            ],
            'categories'=>[
                [
                    'name'=>'چند نفره',
                    'label'=>'type'
                ],
                [
                    'name'=>'یک نفره',
                    'label'=>'type'
                ]
            ],
            'media'=>[
                File::create('test-1.jpg',100),
                File::create('test-2.jpg',100)
            ]
        ];
        
        $this->post(route('article.store'),$data,[
            'enctype'=>'multipart/form-data'
        ]);
      
        
        
        $this->assertTrue(true);
    }
}
