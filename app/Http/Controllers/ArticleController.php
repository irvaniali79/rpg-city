<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return response([
            'Data'=>ArticleResource::collection(Article::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        
        $article=new Article($request->article);         
        $article->categories()->createMany($request->categories);  
        return response([
            'Data'=>[
                $article,
                'type'=>$article->categories->where('label','type')->get('name'),
                'level'=>$article->categories->where('label','level')->get('name'),
                'time'=>$article->categories->where('label','time')->get('name'),
                'lang'=>$article->categories->where('label','lang')->get('name'),
                'multiplayer'=> $article->categories->where('label','multiplayer')->get('name')
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        
        return response([
            'Data'=>[
                $article,
                'type'=>$article->categories->where('label','type')->get('name'),
                'level'=>$article->categories->where('label','level')->get('name'),
                'time'=>$article->categories->where('label','time')->get('name'),
                'lang'=>$article->categories->where('label','lang')->get('name'),
                'multiplayer'=> $article->categories->where('label','multiplayer')->get('name')
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
