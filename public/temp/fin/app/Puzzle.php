<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
     protected $fillable = [ 'name', 'clues_a', 'clues_d', 'file'];
}
