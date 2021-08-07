<?php

namespace App\Http\Controllers;

use App\Models\Starlight;
use Illuminate\Http\Request;
use App\Models\History;
use Auth;
use Validator;
use Response;

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

    public function store(Request $request)
    {
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
                'order' => $request->order,
                'schedule' => $request->schedule,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method
            ];
            $starlightMax = Starlight::max('id');
            $starlightAdded = $starlightMax+1;
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "60001".$starlightAdded,
                'name' => $request->name,
                'order' => $request->order,
                'schedule' => $request->schedule,
                'diamonds' => null,
                'coins' => null,
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => 'Pending',
                'payment_method' => $request->payment_method
            ];
            // dd($data, $dataH);
            Starlight::Create($data);
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
        $starlightData = Starlight::findorFail($id);
        
        $starlightHistories = History::where('request_id', '=', "60001".$id)->orderBy('created_at', 'DESC')->get();
        return view('starlight.show', compact('starlightData', 'starlightHistories'));
    }

    public function update(Request $request, $id)
    {
        $starlightData = Starlight::findorFail($id);
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

            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "60001".$id,
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
            // dd($data, $dataH);
            $starlightData->update($data);
            History::create($dataH);

            return response()->json([
                'success' => 'Successfuly Updated!'
            ]);
        }
    }
}
