<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Diamond;
use App\Models\WebsiteSetting;
use App\Models\History;
use Auth;
use Validator;
use Response;
use Carbon\Carbon;

class DiamondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index(Request $request)
    {
        $users = User::all();
        $diamonds = Diamond::all();
        return view('diamond.index', compact('diamonds'));
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'ml_id' => ['required', 'min:10', 'max:20'],
            'ign' => ['required', 'max:50'],
            'ref' => ['required', 'min:4', 'max:50'],
            'payment_method' => ['required', 'max:50']
        ]);
        
        if(!$validate->passes()){
            return response()->json(['error' => $validate->errors()]);
        }else{
            $webSett = WebsiteSetting::where('id', '=', $request->order)->first();
            $capitalValue = (int) round($webSett->coins_value*$webSett->coins);
            $data = [
                'date' => Carbon::now()->format('m/d'),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method,
                'profit' => $webSett->price-$capitalValue
            ];
            $diamondMax = Diamond::max('id');
            $dataH = [
                'date' => Carbon::now()->format('m/d'),
                'request_by' => Auth::user()->name,
                'request_id' => $diamondMax+1,
                'name' => $request->name,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method,
                'profit' => $webSett->price-$capitalValue
            ];
            Diamond::Create($data);
            History::Create($dataH);

            return response()->json(
                [
                    'success' => 1,
                    'message' => 'Data inserted successfully'
                ]
            );
        }
    }


    public function show($id)
    {
        $diamondData = Diamond::findorFail($id);
        
        $diamondHistories = History::where('request_id', '=', $id)->orderBy('created_at', 'DESC')->get();
        return view('diamond.show', compact('diamondData', 'diamondHistories'));
    }

    public function update(Request $request, $id)
    {
        switch($request->order) {
            case "257":
                $orderID = 1; 
                break;
            case "514":
                $orderID = 2; 
                break;
            case "706":
                $orderID = 3; 
                break;
            case "1412":
                $orderID = 4; 
                break;
            case "2195":
                $orderID = 5; 
                break;
            case "3688":
                $orderID = 6; 
                break;
            case "5532":
                $orderID = 7; 
                break;
            case "9288":
                $orderID = 8; 
                break;
                    
        }
        
        $webSett = WebsiteSetting::where('id', '=', $orderID)->first();
        $capitalValue = (int) round($webSett->coins_value*$webSett->coins);

        $diamondData = Diamond::findOrFail($id);
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'order' => ['required', 'max:10'],
            'ml_id' => ['required', 'min:10', 'max:20'],
            'ign' => ['required', 'max:50'],
            'ref' => ['required', 'min:4', 'max:50'],
            'payment_method' => ['required', 'max:50']
        ]);
            
        if(!$validate->passes()){
            return response()->json(['error' => $validate->errors()]);
        }else{
            $data = [
                'date' => Carbon::now()->format('m/d'),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => $request->status,
                'payment_method' => $request->payment_method,
                'profit' => $webSett->price-$capitalValue

            ];

            $dataH = [
                'date' => date("m/d"),
                'request_id' => $id,
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => $request->status,
                'payment_method' => $request->payment_method,
                'profit' => $webSett->price-$capitalValue

            ];
            
            $diamondData->update($data);
            History::create($dataH);

            return response()->json([
                'success' => 'Successfuly Updated!'
            ]);
        }
    }
}
