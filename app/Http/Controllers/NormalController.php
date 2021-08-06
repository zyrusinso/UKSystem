<?php

namespace App\Http\Controllers;

use App\Models\Normal;
use Illuminate\Http\Request;
use App\Models\History;
use Auth;
use Validator;
use Response;

class NormalController extends Controller
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
        $normals = Normal::all();
        return view('normal.index', compact('normals'));
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'name_of_skin' => ['required', 'max:25'],
            'type_of_skin' => ['required', 'max:25'],
            'ml_to_follow' => ['required', 'min:4', 'max:50'],
            'schedule' => ['required', 'max:50'],
            'payment' => ['required', 'max:10'],
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
                'name_of_skin' => $request->name_of_skin,
                'type_of_skin' => $request->type_of_skin,
                'status' => 'Pending',
                'ml_to_follow' => $request->ml_to_follow,
                'follow_status' => "Pending",
                'schedule' => $request->schedule,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];
            $normalMax = Normal::max('id');
            $normalMaxAdded = $normalMax+1;
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "30001".$normalMaxAdded,
                'name' => $request->name,
                'name_of_skin' => $request->name_of_skin,
                'type_of_skin' => $request->type_of_skin,
                'status' => 'Pending',
                'ml_to_follow' => $request->ml_to_follow,
                'follow_status' => "Pending",
                'schedule' => $request->schedule,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];
            Normal::Create($data);
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
        $normalData = Normal::findorFail($id);

        $normalHistories = History::where('request_id', '=', "30001".$id)->orderBy('created_at', 'DESC')->get();
        return view('normal.show', compact('normalData', 'normalHistories'));
    }

    
    public function update(Request $request, $id)
    {
        $normalData = Normal::findorFail($id);
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'name_of_skin' => ['required', 'max:25'],
            'type_of_skin' => ['required', 'max:25'],
            'ml_to_follow' => ['required', 'min:4', 'max:50'],
            'schedule' => ['required', 'max:50'],
            'payment' => ['required', 'max:10'],
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
                'name_of_skin' => $request->name_of_skin,
                'type_of_skin' => $request->type_of_skin,
                'status' => $request->status,
                'ml_to_follow' => $request->ml_to_follow,
                'follow_status' => $request->follow_status,
                'schedule' => $request->schedule,
                'payment' => $request->payment,
                'ref' => $request->ref,
                'payment_method' => $request->payment_method
            ];
            $normalData->update($data);
            $dataH = [
                'date' => date("m/d"),
                'request_by' => Auth::user()->name,
                'request_id' => "30001".$normalData->id,
                'name' => $request->name,
                'name_of_skin' => $request->name_of_skin,
                'type_of_skin' => $request->type_of_skin,
                'status' => $request->status,
                'ml_to_follow' => $request->ml_to_follow,
                'follow_status' => $request->follow_status,
                'schedule' => $request->schedule,
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
