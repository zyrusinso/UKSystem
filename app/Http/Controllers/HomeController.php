<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function handleAdmin()
    {
        $diamonds = DB::table("diamonds")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $normals = DB::table("normals")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $order_diamonds = DB::table("order_diamonds")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $pilots = DB::table("pilots")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $pre_diamonds = DB::table("pre_diamonds")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $resellers = DB::table("resellers")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $skins = DB::table("skins")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $starlights = DB::table("starlights")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $vips = DB::table("v_i_p_s")
                    ->where('status', 'Pending')
                    ->where('created_at', '>', Carbon::now()->subDays(2))
                    ->count();
        $newOrders = $diamonds+$normals+$order_diamonds+$pilots+$pre_diamonds+$resellers+$skins+$starlights+$vips;
        $registration = User::where('is_admin', '=', 0)->count();


        return view('admin.handleAdmin', compact('registration', 'newOrders'));
    }    
}
