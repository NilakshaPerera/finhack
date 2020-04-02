<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Exam;
use App\Question;
use App\Puzzle;
use App\Presentation;
use Validator;
use Auth;
use App\Library\Helper;
use Carbon\Carbon;

class QuestionController extends Controller {

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
        return view('quiz_start');
    }

    /**
     * getMCQ a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMCQ($q) {

        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }

        $qId = (!$q || $q == 'c45f8e85') ? 0 : $q;
        $back = null;
        $current = null;
        $next = null;
        $a = '';

        $mcqArray = $session->mcq['mcqs'];

        if (!$qId) {
            if (sizeof($mcqArray) > 0) {
                $current = $mcqArray[0]['id'];
                $a = $mcqArray[0]['ans'];
            }
            if (sizeof($mcqArray) > 1) {
                $next = $mcqArray[1]['id'];
            }
        } else {
            for ($i = 0; $i < sizeof($mcqArray); $i++) {
                if ($mcqArray[$i]['id'] == $qId) {
                    $current = $qId;
                    $a = $mcqArray[$i]['ans'];
                    if (($i - 1) >= 0) {
                        $back = $mcqArray[$i - 1]['id'];
                    }
                    if (($i + 1) <= (sizeof($mcqArray) - 1)) {
                        $next = $mcqArray[$i + 1]['id'];
                    }
                    break;
                }
            }
        }

        $id = $current;
        $current = Question::where('id', $current)->select('question', 'answers')->first();

        // If 0, get the zero th value in the array 
        // If greater than zero, get the actual index of the array

        return response()->json(['success' => true, /** 'data' => $current, * */ 'b' => $back, 'c' => $current, 'n' => $next, 'i' => $id, 'a' => $a]);
    }

    /**
     * Created By : Nilaksha
     * Created At : 25-4-2019
     * Summary : Returns the puzzle for the login
     * @param Request $request
     * @return type
     */
    public function getPuzzle(Request $request) {
        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }

        $puzzleArray = $session->puzzle['puzzles'];

        $current = Puzzle::where('id', $puzzleArray)->first();

        return response()->json(['success' => true, 'a' => $current, 'ans' => $session->puzzle['ans']]);
    }

    /**
     * Created By : Nilaksha
     * Created At : 25-4-2019
     * Summary : 
     * @param Request $request
     */
    public function markPuzzle(Request $request) {
        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }

        $validator = Validator::make($request->all(), [
                    'file' => 'required|file',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
        }

        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        $uFileName = time() . '-' . $filename;
        Storage::disk('public_uploads')->putFileAs('puzzle-answers', $uploadedFile, $uFileName);

        $examId = $session->id;
        $session = $session['puzzle'];
        $session['ans'] = $uFileName;
        $row = Exam::find($examId);
        $row['puzzle'] = $session;
        $row->save();

        return response()->json(['success' => true, 'message' => 'Success!']);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function getPresentation(Request $request) {
        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }

        $presentationArray = $session->presentation['presentations'];

        $current = Presentation::where('id', $presentationArray)->first();

        return response()->json(['success' => true, 'a' => $current, 'ans' => $session->presentation['ans']]);
    }

    /**
     * Created By : Nilaksha
     * Created At : 25-4-2019
     * Summary : 
     * @param Request $request
     */
    public function markPresentation(Request $request) {
        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }

        $validator = Validator::make($request->all(), [
                    'file' => 'required|file',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
        }

        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        $uFileName = time() . '-' . $filename;
        Storage::disk('public_uploads')->putFileAs('presentation-answers', $uploadedFile, $uFileName);

        $examId = $session->id;
        $session = $session['presentation'];
        $session['ans'] = $uFileName;
        $row = Exam::find($examId);
        $row['presentation'] = $session;
        $row->save();

        return response()->json(['success' => true, 'message' => 'Success!']);
    }
     //get the video file upload

     public function markvideos(Request $request) {
        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }

        $validator = Validator::make($request->all(), [
                    'file' => 'required|file',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
        }

        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        $uFileName = time() . '-' . $filename;
        Storage::disk('public_uploads')->putFileAs('video-answers', $uploadedFile, $uFileName);

        $examId = $session->id;
        $session = $session['presentation'];
        $session['vid'] = $uFileName;
        $row = Exam::find($examId);
        $row['presentation'] = $session;
        $row->save();

        return response()->json(['success' => true, 'message' => 'Success!']);
    }

    /**
     * The start/end quiz
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setSessionState(Request $request) {
        $currectSession = Helper::currentSession();
        if (!$currectSession) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }
        $examId = $currectSession->id;
        $currectSession = $currectSession[$request['quiz']];
        if (!$currectSession[$request['state']]) {
            $currectSession[$request['state']] = Carbon::now()->timestamp;
            $row = Exam::find($examId);
            $row[$request['quiz']] = $currectSession;
            $row->save();
        }
        return response()->json(['success' => true, 'message' => $currectSession]);
    }

    /**
     * Created By : Nilaksha 
     * Created At : 21-4-2019
     * Summary : Ends current active session of a certain user
     * @param Request $request
     */
    public function endSession(Request $request) {
        $currectSession = Helper::currentSession();
        if (!$currectSession) {
            return response()->json(['success' => false, 'message' => 'No active session for this use found.']);
        }
        Exam::where('id', $currectSession->id)
                ->update(['ended' => date("Y-m-d H:i:s")]);
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Success']);
    }

    /**
     * Created By : Nilaksha 
     * Created At : 23-4-2019
     * Summary : Mark user updated answers in the database.
     * Incoming params : answer, question
     * @param Request $request
     * @return type
     */
    public function markMCQ(Request $request) {

        $session = Helper::currentSession();
        if (!$session & (!$request['question'] || !$request['answer'] )) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }
        $mcqArray = $session->mcq;

        for ($i = 0; $i < sizeof($mcqArray['mcqs']); $i++) {
            if ($mcqArray['mcqs'][$i]['id'] == $request['question']) {
                $mcqArray['mcqs'][$i]['ans'] = $request['answer'];
                break;
            }
        }
        $row = Exam::find($session->id);
        $row['mcq'] = $mcqArray;
        $row->save();

        return response()->json(['success' => true, 'message' => $mcqArray]);
    }

}
