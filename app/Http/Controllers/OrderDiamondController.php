<?php

namespace App\Http\Controllers;

use App\Models\OrderDiamond;
use Illuminate\Http\Request;

class OrderDiamondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $order_diamonds = OrderDiamond::all();
        return view('order_diamond.index', compact('order_diamonds'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDiamond  $orderDiamond
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDiamond $orderDiamond)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDiamond  $orderDiamond
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDiamond $orderDiamond)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDiamond  $orderDiamond
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDiamond $orderDiamond)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDiamond  $orderDiamond
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDiamond $orderDiamond)
    {
        //
    }
}
