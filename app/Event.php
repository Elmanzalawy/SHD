<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //creating model relationship (many to one)
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function eventRegister(){
        return $this->belongsTo('App\EventRegister');
    }
}
