<?php

namespace App\Http\Controllers;

use App\Models\OrderDiamond;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\WebsiteSetting;

use Auth;
use Validator;
use Response;

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

    
    public function store(Request $request)
    {
        $webSett = WebsiteSetting::where('id', '=', $request->order)->first();
        $capitalValue = (int) round($webSett->coins_value*$webSett->coins);

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'order' => ['required', 'max:10'],
            'schedule' => ['required', 'max:25'],
            'ml_id' => ['required', 'min:10', 'max:20'],
            'ign' => ['required', 'max:50'],
            'ref' => ['required', 'min:4', 'max:50'],
            'payment_method' => ['required', 'max:50']
        ]);
        
        if(!$validate->passes()){
            return response()->json(['error' => $validate->errors()]);
        }else{

            $data = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method
            ];
            $orderDiamondMax = OrderDiamond::max('id');
            $orderDiamondAdded = $orderDiamondMax+1;
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "50001".$orderDiamondAdded,
                'name' => $request->name,
                'schedule' => $request->schedule,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method
            ];
            // dd($data, $dataH);
            OrderDiamond::Create($data);
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
        $order_diamondData = OrderDiamond::findorFail($id);
        
        $orderDiamondHistories = History::where('request_id', '=', "50001".$id)->orderBy('created_at', 'DESC')->get();
        return view('order_diamond.show', compact('order_diamondData', 'orderDiamondHistories'));
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

        $orderDiamondData = OrderDiamond::findorFail($id);
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'order' => ['required', 'max:10'],
            'schedule' => ['required', 'max:25'],
            'ml_id' => ['required', 'min:10', 'max:20'],
            'ign' => ['required', 'max:50'],
            'ref' => ['required', 'min:4', 'max:50'],
            'payment_method' => ['required', 'max:50']
        ]);
            
        if(!$validate->passes()){
            return response()->json(['error' => $validate->errors()]);
        }else{
            $data = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $webSett->price,
                'diamonds' => $webSett->diamonds,
                'coins' => $webSett->coins,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => $request->status,
                'payment_method' => $request->payment_method
            ];

            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "50001".$id,
                'name' => $request->name,
                'order' => $request->order,
                'schedule' => $request->schedule,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => $request->status,
                'payment_method' => $request->payment_method
            ];
            $orderDiamondData->update($data);
            History::create($dataH);

            return response()->json([
                'success' => 'Successfuly Updated!'
            ]);
        }
    }
}
