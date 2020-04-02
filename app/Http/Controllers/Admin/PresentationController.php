<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use Hash;
use App\Presentation;


class PresentationController extends Controller {

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Constructor check if user is logged in
     */
    public function __construct() {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Created By : Nilaksha
     * Created At : 7-3-2019
     * Summary : Returns User blade under admin views section
     * @return type
     */
    public function index() {
        return view('admin.presentation.presentation');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 9-4-2019
     * Summary : Create new question
     * @param Request $request
     * @return type
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txttitle' => 'required',
                    'txttitle1' => 'required',
                    'txtanswers' => 'required',

        ]);
        if ($validator->fails()) {
             return redirect('admin/quizes')->with('errors', $validator->errors()->all());
        }
        
        $answersArray = array();
        $i = 1;
        foreach($request['txtanswers'] as $answer){
            $answersArray[$i] = $answer;
            $i++;
        }
        
        $user = Presentation::create(array(
                    'name' => $request['txttitle'],
                    'Body' => $request['txttitle1'],
                    'clues' =>  json_encode($answersArray),
                  
        ));
        return redirect('admin/presentations')->with('status', 'Presentation Created!');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Edit a user in the admin section
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $questions = Presentation::where('id', $id)->first();
        $data = array('presentation' => $questions);
        return view('admin.presentation.edit_presentation')->with('data', $data);
    }

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Update a user with new values
     * @param Request $data
     * @return type
     */
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txttitle' => 'required',
                    'txtanswers' => 'required',
        ]);
        if ($validator->fails()) {
             return redirect('admin/presentations')->with('errors', $validator->errors()->all());
        }
        
        $answersArray = array();
        $i = 1;
        foreach($request['txtanswers'] as $answer){
            $answersArray[$i] = $answer;
            $i++;
        }
        
        $user = Presentation::where(
                'id' , $request['hash'] )
                ->update(
                array(
                    'name' => $request['txttitle'],
                    'clues' =>  json_encode($answersArray),
        ));
        return redirect('admin/presentations/'. $request['hash'] .'/edit')->with('status', 'Presentation Updated!');
    }

}
