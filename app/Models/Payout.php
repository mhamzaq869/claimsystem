<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['user_id','withdrawn','paid','project_id','vendor_earning','admin_earning','trans_id','bank','status','vendor_order'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function withdrawn(){
        return $this->belongsTo('App\Models\Withdrawn');
    }
}
