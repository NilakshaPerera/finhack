<?php

namespace App\Http\Controllers\Site; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Exam;
use App\Question;
use App\Puzzle;
use App\Presentation;
use App\Library\Helper;
use Auth;
class SessionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['auth', 'verified', 'student']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        // Silence is golden
    }

    /**
     * Created By : Nilaksha 
     * Created At : 15-4-2019
     * Summary : Will return the current unfinished session at any time if unfinished sessions are not available, 
     *          the function will generate a list of mcqs from Questions table, 
     *          get a puzzle question from the puzzle pool.
     *          get a presentation question from the presentation pool manually
     *          and prepare the quiz. 
     *          A JSON version is sent back to the front end to be saved as a cookie
     * 
     * Created By : Pumuditha
     * Created At : 23-8-2019
     * Summary : Removing MCQ and Puzzle related code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function session(Request $request) {

        $currectSession = Helper::currentSession();
        if (!$currectSession) {
           
          //  get random presentations
            $presentation = Presentation::select('id')->inRandomOrder()->first();
          

            $presentation = ['started' => '', 'ended' => '', 'timeoutin' => Setting::where('setting' , 'presentation_time')->first()->data, 'presentations' => $presentation->id, 'ans' => '', 'vid'=>''];

            $currectSession = Exam::create([
                        'user_id' => Auth::user()->id,
                        'session' => Helper::randomString(),
                        'presentation' => $presentation,
                        'started' => date("Y-m-d H:i:s"),
            ]);
        }

        $sessArray = [
            'session' => $currectSession->session,
            'presentation' => $currectSession->presentation
        ];
        return response()->json(['success' => true, 'data' => $sessArray]);
    }

}
