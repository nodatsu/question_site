<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
 
    public function question() {
        return $this->belongsTo('App\Models\Question');
    }

}
