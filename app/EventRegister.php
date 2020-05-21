<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegister extends Model
{
    public $table = "event_register";
    //creating model relationship (many to one)
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function event(){
        return $this->hasMany('App\Event');
    }
}
