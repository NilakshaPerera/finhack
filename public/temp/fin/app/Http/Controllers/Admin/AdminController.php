<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Validator;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'admin']);
    }

    public function index() {
        return view('admin.starter');
    }

    /**
     * Created By : Nilaksha
     * Created At : 26-4-2019
     * Summary  : saves all the settings 
     * @param Request $request
     */
    function score(Request $request) {

        $settings = Setting::all();
        $validateArray = [];
        $valArray = [];

        foreach ($settings as $setting) {
            $validateArray[$setting->setting] = 'required';
            $valArray[$setting->setting] = $request[$setting->setting];
        }

        $validator = Validator::make($request->all(), $validateArray);
        
        if ($validator->fails()) {
            return array(
                'success' => false,
                'errors' => $validator->errors()->all(),
            );
        }
        
        foreach($valArray as $index=>$value){
            Setting::where('setting' , $index)
                    ->update(['data' => $value]);
        }
        return array(
            'success' => true,
        );
    }

}
