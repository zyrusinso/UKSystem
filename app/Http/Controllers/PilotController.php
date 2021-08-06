<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\History;



class PilotController extends Controller
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
        $pilots = Pilot::all();
        return view('pilot.index', compact('pilots'));
    }


    public function calculator()
    {
        return view('pilot.calculator');
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'initial_rank' => ['required', 'max:50'],
            'target_rank' => ['required', 'max:50'],
            'request' => ['max:250'],
            'handler' => ['required', 'max:50'],
            'tf' => ['required', 'max:25'],
            'payment' => ['required', 'max:50'],
            'ref' => ['required', 'max:50'],
            'payment_method' => ['required', 'max:50']
        ]);
        
        if(!$validate->passes()){
            return response()->json(['error' => $validate->errors()]);
        }else{

            $data = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'initial_rank' => $request->initial_rank,
                'target_rank' => $request->target_rank,
                'status' => 'Pending',
                'user_req' => $request->user_req,
                'handler' => $request->handler,
                'tf' => $request->tf,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];
            $pilotMax = Pilot::max('id');
            $pilotMaxAdded = $pilotMax+1;
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "20001".$pilotMaxAdded,
                'name' => $request->name,
                'initial_rank' => $request->initial_rank,
                'target_rank' => $request->target_rank,
                'status' => 'Pending',
                'user_req' => $request->user_req,
                'handler' => $request->handler,
                'tf' => $request->tf,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];
            
            Pilot::Create($data);
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
        
        $pilotData = Pilot::findorFail($id);
        
        $pilotHistories = History::where('request_id', '=', "20001".$id)->orderBy('created_at', 'DESC')->get();
        return view('pilot.show', compact('pilotData', 'pilotHistories'));
    }

    
    public function update(Request $request, $id)
    {
        $pilotData = Pilot::findorFail($id);
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'initial_rank' => ['required', 'max:20'],
            'target_rank' => ['required', 'max:20'],
            'handler' => ['required', 'max:50'],
            'tf' => ['required', 'max:20'],
            'payment' => ['required', 'max:50'],
            'ref' => ['required', 'max:50'],
            'payment_method' => ['required', 'max:50']
        ]);
            
        if(!$validate->passes()){
            return response()->json(['error' => $validate->errors()]);
        }else{
            $data = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'initial_rank' => $request->initial_rank,
                'target_rank' => $request->target_rank,
                'status' => $request->status,
                'user_req' => $request->user_req,
                'handler' => $request->handler,
                'tf' => $request->tf,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];
            
            $pilotData->update($data);

            $dataH = [
                'date' => date("m/d"),
                'request_id' => "20001".$id,
                'request_by' => Auth::user()->name,
                'name' => $request->name,
                'initial_rank' => $request->initial_rank,
                'target_rank' => $request->target_rank,
                'status' => $request->status,
                'user_req' => $request->user_req,
                'handler' => $request->handler,
                'tf' => $request->tf,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];

            History::create($dataH);

            return response()->json([
                'success' => 'Successfuly Updated!'
            ]);
        }
    }
}
