<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Welcome as WelcomeResource;
use App\User;
use Validator;
use Auth;
use App\Participant;

class WelcomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'student']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function user(Request $rquest)
    {
        return new WelcomeResource(Auth::user());
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

        // dd($request['name']);

        $validator = Validator::make($request->all(), [
            'university' => 'required',
            'lecturer' => 'required',
            'lecturer_email' => 'required',
            'lecturer_Pno' => 'required',
            'team_name' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        $i = 0;
        foreach ($request['name']  as $name) {

            $user = Participant::create(array(
                'user_id' => Auth::user()->id,
                'name' =>  $name,
                'email' =>  $request['email'][$i],
                'phone' =>  $request['phone'][$i],
            ));

            ++$i;
        }


        // $namear = json_decode($request['field1'], true);
        // $emailar = json_decode($request['field2'], true);
        // $phonear = json_decode($request['field3'], true);
        // $i = 0;

        // foreach(field1 as $name){

        //    $user = Participant::create(array(

        //         'name' =>  json_encode($namear[$i]),
        //         'email' =>  json_encode($emailar[$i]),
        //         'phone' =>  json_encode($phonear[$i]),
        //                ));
        // }
        // for($i = 0; $i< sizeof($namear); $i++){

        //     $user = Participant::create(array(

        //         'name' =>  json_encode($namear[$i]),
        //         'email' =>  json_encode($emailar[$i]),
        //         'phone' =>  json_encode($phonear[$i]),
        //                ));
        // }
        // foreach($namear as $i => $value) {
        //                $user = Participant::create(array(

        //         'name' =>  json_encode($namear[$i]),
        //         'email' =>  json_encode($emailar[$i]),
        //         'phone' =>  json_encode($phonear[$i]),
        //                ));
        // }




         if (Auth::user()) {
             User::where('id' , Auth::user()->id)
                     ->update(['university' => $request['university'] , 'lecturer' => $request['lecturer'], 'lecturer_email' => $request['lecturer_email'],'lecturer_Pno' => $request['lecturer_Pno'] ,'team_name' => $request['team_name'] ]);


                     return response()->json(['success' => true, 'message' => array('Success!')]);
         }

        return response()->json(['success' => false, 'errors' => $request['name']]);
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
