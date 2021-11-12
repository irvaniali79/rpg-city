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
use App\Http\Controllers\BillController;
use Illuminate\Http\Request;

class RequestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//     use RefreshDatabase;
    
    public function test_article_store() {
        
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
    
    public function test_bill_store(){
        
        $billcontroller=new BillController();
        $response=$billcontroller->
        store(new Request(['article_id'=>2,'basket_id'=>3,'user_id'=>2,'address_id'=>2]));

        $this->assertEquals($response->status(),200);
        
        
    }
}
