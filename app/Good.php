<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
 
    public function question() {
        return $this->belongsTo('App\Question');
    }
    public function reply(){
        return $this->belongsTo('App\Reply');
    }

}
