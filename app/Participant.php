<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model {

    protected $fillable = [ 'user_id', 'name', 'email','phone'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}