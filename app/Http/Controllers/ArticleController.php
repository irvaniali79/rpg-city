<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ArticleController extends Controller
{
    use RefreshDatabase;
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
    public function store(Request $request)
    {
        $article=new Article();
        $article=$article->create($request->article);

       
       
        foreach ($request->media as $file){
            $path = $file->storePublicly('images');
            
            $article->media()->create(['path'=>$path]);
        
        }
        
        $article->categories()->createMany($request->categories);  
        
        return response([
            'Data'=>[
                $article,
                'media'=>[
                    $article->media
                ],
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
