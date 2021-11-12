<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use function GuzzleHttp\Promise\all;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response([
            'Data'=>Bill::orderBy('created_at','asc')->get()->load('user')
        ]);
    }
    public function completedbill(){
        
        return response([
            'Data'=>Bill::orderBy('created_at','asc')->where('status','complete')->get()->load('user')
        ]);
        
        
    }
    public function uncompeletedbill() {
        
        return response([
            'Data'=>Bill::orderBy('created_at','asc')->where('status','<>','complete')->get()->load('user')
        ]);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::login(User::find($request->user_id));
        
        $basket=Basket::find($request->basket_id);
        $address=Address::find($request->address_id);
        
        $bill=auth()->user()->bills()->create();
        $bill->basket()->create((new Collection($basket))->except(['id','bill_id','created_at','updated_at','user_id'])
            ->all());
            
        $bill->address()->create((new Collection($address))->except(['id','created_at','updated_at','bill_id'])->all());
        
        $basket->delete();
        
        
        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }


}
