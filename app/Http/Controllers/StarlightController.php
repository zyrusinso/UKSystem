<?php

namespace App\Http\Controllers;

use App\Models\Starlight;
use Illuminate\Http\Request;

class StarlightController extends Controller
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
        $starlights = Starlight::all();
        return view('starlight.index', compact('starlights'));
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
     * @param  \App\Models\Starlight  $starlight
     * @return \Illuminate\Http\Response
     */
    public function show(Starlight $starlight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Starlight  $starlight
     * @return \Illuminate\Http\Response
     */
    public function edit(Starlight $starlight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Starlight  $starlight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Starlight $starlight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Starlight  $starlight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Starlight $starlight)
    {
        //
    }
}
