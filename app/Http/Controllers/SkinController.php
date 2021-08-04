<?php

namespace App\Http\Controllers;

use App\Models\Skin;
use Illuminate\Http\Request;

class SkinController extends Controller
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
        $skins = Skin::all();
        return view('skin.index', compact('skins'));
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
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function show(Skin $skin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function edit(Skin $skin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skin $skin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skin  $skin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skin $skin)
    {
        //
    }
}
