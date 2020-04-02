<?php

namespace App\Library;
use Auth;
use App\Exam;

class Helper {

    /**
     * Created By : Nilaksha 
     * Created At : 7-3-2019
     * Summary : Will return a random string for the defined 
     * @param type $length
     * @return string
     */
   static function randomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    /**
     * Created By : Nilaksha
     * Created At : 22-4-2019
     * Summary : Gets the unfinished active session for the current logged un user.
     * @return type
     */
    static function currentSession(){
      return  Exam::where('user_id', Auth::user()->id)
                ->where('ended', null)
                ->first();
    }

}
