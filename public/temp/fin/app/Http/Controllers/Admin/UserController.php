<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use Validator;
use Hash;


class UserController extends Controller {

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
        return view('admin.user');
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
                    'txtname' => 'required',
                    'txtusername' => 'required|unique:users,email',
                    'txtpassword' => 'required',
                    
        ]);
        if ($validator->fails()) {
             return redirect('admin/user')->with('errors', $validator->errors()->all());
             //return Redirect::to('admin.user', array('name' => $validator->errors()->all()));
            //return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        $user = User::create(array(
                    'role_id' => 2,
                    'name' => $request['txtname'],
                    'email' => $request['txtusername'],
                    'raw_password' => $request['txtpassword'],
                    'password' => Hash::make($request['txtpassword']),
                    'university' => $request['txtuniversity'],
                    'lecturer' => $request['txtlecturer'],
                    'team_name' => $request['txtteam_name'],
                    
        ));
        return redirect('admin/user')->with('status', 'Account created!');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Edit a user in the admin section
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $users = User::where('id', $id)->first();
        $data = array('users' => $users);
        return view('admin.edit_users')->with('data', $data);
    }

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Update a user with new values
     * @param Request $data
     * @return type
     */
    public function update(Request $data) {
        $validator = Validator::make($data->all(), [
                    'txtname' => 'required',
                    'txtemail' => 'required|email|max:255', // unique:users.email| //'required|email|max:255|unique:users.email',
                    'txtpassword' => 'required|max:12',
        ]);

        if ($validator->fails()) {
            return array(
                'success' => false,
                'errors' => $validator->errors(),
            );
        }

        $userData = array(
            'name' => $data['txtname'],
            'email' => $data['txtemail'],
            'raw_password' => $data['txtpassword'],
            'password' => Hash::make($data['txtpassword']),
        );
        User::where('id', $data['hash'])
                ->update($userData);

        return array(
            'success' => true,
        );
    }

}
