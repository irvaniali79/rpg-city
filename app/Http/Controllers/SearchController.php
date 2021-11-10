<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Pluralizer;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;
use App\Http\Requests\SearchRequest;
use App\Models\Article;


class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SearchRequest $request)
    {
        
        $table=strtolower(Pluralizer::plural($request->model));
        
        
        if(Schema::hasTable($table)){
            
            $class="App\\Models\\".$request->model;
            $query=$class::search($request->search)->get();
           
            return response([
                'Data'=>$query
            ],200);
        }
        return response(404);
    }
}
