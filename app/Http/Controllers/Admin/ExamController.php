<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use Hash;
use App\Exam;
use App\Question;
use Auth;

class ExamController extends Controller {

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Constructor check if user is logged in
     */
    public function __construct() {
        $this->middleware(['auth','common']);
    }

    /**
     * Created By : Nilaksha
     * Created At : 7-3-2019
     * Summary : Returns User blade under admin views section
     * @return type
     */
    public function index() {
        return view('admin.exam');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 24-4-2019
     * @param type $id
     * @return type
     */
    public function show($id) {
        return view('admin.exam-item')->with(['data' => $id]);
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
                    'txtquestion' => 'required',
                    'txtanswers' => 'required',
                    'txtanswer' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/quizes')->with('errors', $validator->errors()->all());
        }

        $answersArray = array();
        $i = 1;
        foreach ($request['txtanswers'] as $answer) {
            $answersArray[$i] = $answer;
            $i++;
        }

        $user = Question::create(array(
                    'title' => $request['txttitle'],
                    'question' => $request['txtquestion'],
                    'answers' => json_encode($answersArray),
                    'answer' => $request['txtanswer'],
        ));
        return redirect('admin/quizes')->with('status', 'Question Created!');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Edit a user in the admin section
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $questions = Question::where('id', $id)->first();
        $data = array('question' => $questions);
        return view('admin.edit_quiz')->with('data', $data);
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
                    'txtquestion' => 'required',
                    'txtanswers' => 'required',
                    'txtanswer' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/quizes')->with('errors', $validator->errors()->all());
        }

        $answersArray = array();
        $i = 1;
        foreach ($request['txtanswers'] as $answer) {
            $answersArray[$i] = $answer;
            $i++;
        }

        $user = Question::where(
                        'id', $request['hash'])
                ->update(
                array(
                    'title' => $request['txttitle'],
                    'question' => $request['txtquestion'],
                    'answers' => json_encode($answersArray),
                    'answer' => $request['txtanswer'],
        ));
        return redirect('admin/quizes/' . $request['hash'] . '/edit')->with('status', 'Question Updated!');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 25-4-2019
     * Summary : store the scores 
     * @param Request $request
     */
    public function score(Request $request) {
        if(Auth::user()->role_id != 1) {
            return redirect('admin/exams/' . $request['id']) ;
        }
        $validator = Validator::make($request->all(), [
                    // 'mcq-score' => 'required',
                    // 'puzzle-score' => 'required',
                    'presentation-score' => 'required',
                    'id' => 'required',
                    
        ]);
        if ($validator->fails()) {
            return redirect('admin/exams/' . $request['id'])->with('errors', $validator->errors()->all());
        }

        Exam::where('id' , $request['id'])
                ->update([
                    'presentation_score' => $request['presentation-score']
                ]);        

        return redirect('admin/exams/' . $request['id'])->with('status', 'Scores added');
    }

     /**
     * Created By : Nilaksha
     * Created At : 10-9-2019
     * Summary : store the video
     * @param Request $request
     */
    public function video(Request $request) {
        $session = Helper::currentSession();
        if (!$session) {
            return response()->json(['success' => false, 'message' => "Session not found"]);
        }
        $validator = Validator::make($request->all(), [
                    
                    'id' => 'required',
                    'file' => 'required|file',
        ]);
        if ($validator->fails()) {
            return redirect('admin/exams/' . $request['id'])->with('errors', $validator->errors()->all());
        }
        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        $uFileName = time() . '-' . $filename;
        Storage::disk('public_uploads')->putFileAs('video-answers-admin', $uploadedFile, $uFileName);


        $examId = $session->id;
        $session = $session['presentation'];
        $session['video'] = $uFileName;
        $row = Exam::find($examId);
        $row['presentation'] = $session;
        $row->save();        

        return redirect('admin/exams/' . $request['id'])->with('status', 'Video Uploaded');
    }

}
