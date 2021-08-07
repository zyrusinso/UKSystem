<?php

namespace App\Http\Controllers;

use App\Models\VIP;
use Illuminate\Http\Request;
use App\Models\History;
use Auth;
use Validator;
use Response;

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

    public function store(Request $request)
    {
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
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $request->order,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method
            ];
            $vipMax = VIP::max('id');
            $vipAdded = $vipMax+1;
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "70001".$vipAdded,
                'name' => $request->name,
                'order' => $request->order,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method
            ];
            // dd($data, $dataH);
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
        $vipData = VIP::findorFail($id);
        
        $vipHistories = History::where('request_id', '=', "70001".$id)->orderBy('created_at', 'DESC')->get();
        return view('vip.show', compact('vipData', 'vipHistories'));
    }

    public function update(Request $request, $id)
    {
        $vipData = VIP::findorFail($id);
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
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $request->order,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => $request->status,
                'payment_method' => $request->payment_method
            ];

            $dataH = [
                'date' => date("m/d"),
                'request_id' => "70001".$id,
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'order' => $request->order,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => $request->status,
                'payment_method' => $request->payment_method
            ];
            // dd($data, $dataH);
            $vipData->update($data);
            History::create($dataH);

            return response()->json([
                'success' => 'Successfuly Updated!'
            ]);
        }
    }
}
