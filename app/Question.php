<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    public function interests() {
        return $this->hasMany('App\Interest');
    }
    public function goods(){
        return $this->hasmany('App\Good');
    }
}
