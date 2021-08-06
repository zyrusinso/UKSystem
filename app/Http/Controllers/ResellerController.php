<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Models\History;
use Auth;
use Validator;
use Response;

class ResellerController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $resellers = Reseller::all();

        
        return view('reseller.index', compact('resellers'));
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
            $sellerMax = Reseller::max('id');
            $sellerMaxAdded = $sellerMax+1;
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "10001".$sellerMaxAdded,
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
            Reseller::Create($data);
            History::Create($dataH);

            return response()->json(
                [
                    'success' => 1,
                    'message' => 'Data inserted successfully'
                ]
            );
        }
    }

   
    public function show(Reseller $reseller, $id)
    {
        
        $resellerData = Reseller::findorFail($id);
        
        $resellerHistories = History::where('request_id', '=', "10001".$id)->orderBy('created_at', 'DESC')->get();
        return view('reseller.show', compact('resellerData', 'resellerHistories'));
    }

    
    public function update(Request $request, $id)
    {
        $resellerData = Reseller::findorFail($id);
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
            $resellerData->update($data);

            $dataH = [
                'date' => date("m/d"),
                'request_id' => "10001".$id,
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
            
            History::create($dataH);

            return response()->json([
                'success' => 'Successfuly Updated!'
            ]);
        }
    }
}
