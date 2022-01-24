<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return response([
            "Data"=>[
                "best_seller"=>Article::orderBy('solved_count', 'desc')->limit(10)->get(),
                "newist"=>Article::orderBy('created_at', 'desc')->limit(10)->get()
            ]
        ]);

    }
}
