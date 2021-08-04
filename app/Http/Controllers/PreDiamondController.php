<?php

namespace App\Http\Controllers;

use App\Models\PreDiamond;
use Illuminate\Http\Request;

class PreDiamondController extends Controller
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
        $pre_diamonds = PreDiamond::all();
        return view('pre_diamond.index', compact('pre_diamonds'));
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
     * @param  \App\Models\PreDiamond  $preDiamond
     * @return \Illuminate\Http\Response
     */
    public function show(PreDiamond $preDiamond)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreDiamond  $preDiamond
     * @return \Illuminate\Http\Response
     */
    public function edit(PreDiamond $preDiamond)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreDiamond  $preDiamond
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreDiamond $preDiamond)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreDiamond  $preDiamond
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreDiamond $preDiamond)
    {
        //
    }
}
