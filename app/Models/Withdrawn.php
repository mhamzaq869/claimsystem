<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawn extends Model
{

    public function user(){
        return $this->hasMany('App\User');
    }
    public function payout(){
        return $this->hasMany('App\Models\Payout');
    }

}
