<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $fillable = ['user_id','contract_id', 'message','to_user'];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function toUser(){
        return $this->belongsTo('App\User','to_user','id');
    }

}
