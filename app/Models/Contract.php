<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = ['user_id', 'project_id', 'req_by_user','acc_by_user','delivery','price','expired','completed','status'];


    public function user(){
        return $this->hasOne('App\User','id','acc_by_user');
    }
    public function requser(){
        return $this->hasOne('App\User','id','req_by_user');
    }

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
}
