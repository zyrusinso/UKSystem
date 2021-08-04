<?php

namespace App\Http\Controllers;

use App\Models\VIP;
use Illuminate\Http\Request;

class VIPController extends Controller
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
        $vips = VIP::all();
        return view('vip.index', compact('vips'));
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
     * @param  \App\Models\VIP  $vIP
     * @return \Illuminate\Http\Response
     */
    public function show(VIP $vIP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VIP  $vIP
     * @return \Illuminate\Http\Response
     */
    public function edit(VIP $vIP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VIP  $vIP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VIP $vIP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VIP  $vIP
     * @return \Illuminate\Http\Response
     */
    public function destroy(VIP $vIP)
    {
        //
    }
}
