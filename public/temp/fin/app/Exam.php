<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {

    protected $fillable = ['user_id', 'session', 'mcq', 'puzzle', 'presentation', 'started', 'ended' , 'mcq_score', 'puzzle_score', 'presentation_score'];

    protected $casts = [
        'mcq' => 'array', 'puzzle' => 'array', 'presentation' => 'array',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
