<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Basket;
use App\Models\Favorite;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        User::factory(5)->has(Basket::factory(1)->has(Article::factory(5)))
        ->has(Favorite::factory(1)->has(Article::factory(5)))->create();
        
    }
}
