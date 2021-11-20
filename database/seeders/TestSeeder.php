<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Article;
use App\Models\Basket;
use App\Models\Favorite;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Comment;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       User::factory(5)->has(Basket::factory(1)->has(Article::factory(5)))
        ->has(Favorite::factory(1)->has(Article::factory(5)))->
       has(Bill::factory(3)->has(Basket::factory(1)))->hasAddresses(1)->create();
       
       Article::factory(5)->hasCategories(5)->create(); 

        
      
    }
}
