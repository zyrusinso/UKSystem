<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Diamond;
use Auth;
use Validator;

class DiamondController extends Controller
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
    
    public function index(Request $request)
    {
        $diamonds = Diamond::all();

        $search = Diamond::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%'.$term.'%')->get();
                }
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(10);
        
        return view('diamond.index', compact('search', 'diamonds'))
            ->with('i', (request()->input('search', 1) - 1)* 5);

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
        dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'order' => ['required'],
            'ml_id' => ['required'],
            'ign' => ['required'],
            'ref' => ['required'],
            'payment_method' => ['required']
        ]);
        
        if(!$validate->passes()){
            return response()->json(['status'=>0, 'error'=>$validate->errors()->toArray()]);
        }else{

            $data = Diamond::updateOrCreate([
                'date' => date("m/d"),
                'request_by' => $request->name,
                'name' => Auth::user()->name,
                'order_value' => $request->order,
                'diamonds_value' => '',
                'coins_value' => '',
                'ml_id' => $request->ml_id,
                'ign' => $request->ign,
                'ref' => $request->ref,
                'status' => '',
                'payment_method' => $request->payment_method
            ]);
 
              return response()->json(
                [
                    'status' => 1,
                    'success' => true,
                    'message' => 'Data inserted successfully'
                ]
              );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
